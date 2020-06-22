<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActionModel;
use App\Models\ActionRouteModel;
use App\Models\LoggingDetailsModel;
use App\Models\LoggingMastersModel;
use App\Models\SystemUserModel;
use http\Env\Response;
use Route;

//    use App\Models\ArticleModel;
// use App\Models\InquiryModel;
//  use App\Models\CommentsModel;

class SuperAdminController extends Controller
{

    const PACKAGES_UPLOAD_FOLDER = "packages";
    public $langugeArray = ['en', 'ar'];
    public $characters = ["", "A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z",
        "AA", "AB", "AC", "AD", "AE", "AF", "AG", "AH", "AI", "AJ", "AK", "AL", "AM", "AN", "AO", "AP", "AQ", "AR", "AS", "AT", "AU", "AV", "AW", "AX", "AY", "AZ",
        "BA", "BB", "BC", "BD", "BE", "BF", "BG", "BH", "BI", "BJ", "BK", "BL", "BM", "BN", "BO", "BP", "BQ", "BR", "BS", "BT", "BU", "BV", "BW", "BX", "BY", "BZ"
        , "CA", "CB", "CC", "CD", "CE", "CF", "CG", "CH", "CI", "CJ", "CK", "CL", "CM", "CN", "CO", "CP", "CQ", "CR", "CS", "CT", "CU", "CV", "CW", "CX", "CY", "CZ"
        , "DA", "DB", "DC", "DD", "DE", "DF", "DG", "DH", "DI", "DJ", "DK", "DL", "DM", "DN", "DO", "DP", "DQ", "DR", "DS", "DT", "DU", "DV", "DW", "DX", "DY", "DZ"];

    public static $data = [];

    public function __construct()
    {
        self::$data['cp_route_name'] = config('app.cp_route_name');

        $ADMIN_PANEL = config('app.cp_route_name');
        $user = \Auth::user();

        if (!\Request::ajax()) {
            //  self::$data["menuActionsValue"]["37"]=ArticleModel::getBlogsWaitingCount();
            //  self::$data["menuActionsValue"]["39"]=CommentsModel::getWaitingCount();
            //  self::$data["menuActionsValue"]["45"]=InquiryModel::getWaiting();
            if ($user) {
                self::$data["menuActions"] = ActionModel::getMenu($user->SysUsr_ID);
            }
        } else {
            ///
        }

        if ($user) {

            self::$data["allowedActions"] = $user->actions()->lists("Action_ID")->toArray();
            self::$data["actionListAuth"] = $user->getUserActions();
            self::$data["adminUser"] = $user;
            $route = ActionRouteModel::where("ActRoute_RouteName", Route::currentRouteName())->first();
            self::$data["actionRouteName"] = isset($route->action->Action_Name) ? $route->action->Action_Name : "";
            if ($route) {
                self::$data["canLog"] = $route->ActRoute_IsLogging;
                self::$data["canLogDetails"] = $route->ActRoute_IsLoggingDetails;
            }
        }
    }


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function uploadAjax($dest = 'package')
    {
        $path = public_path('uploads'); // upload directory
        $file = \Input::file('choose-file');
        $ext = $file->guessClientExtension();
        $message = '';
        $filename = time() . str_random(25) . '.' . $ext;
        $uploadSuccess = $file->move($path . DIRECTORY_SEPARATOR . $dest, $filename);

        if ($uploadSuccess) {
            return response(array('status' => 1, 'file_name' => $filename, 'my_server' => \URL::asset('')));
        } else {
            return response(array('status' => 2, 'message' => $message));
        }
    }

    public function uploadProfile()
    {
        $path = public_path('uploads'); // upload directory
        $file = \Input::file('choose-file');
        $ext = $file->guessClientExtension();
        $message = '';
        $filename = time() . str_random(25) . '.' . $ext;
        $uploadSuccess = $file->move($path . DIRECTORY_SEPARATOR . "users", $filename);

        if ($uploadSuccess) {
            $user = SystemUserModel::find(\Auth::user("admin")->SysUsr_ID);
            $user->SysUsr_ThumbImage = $filename;
            $user->save();
            return response(array('status' => 1, 'file_name' => $filename, 'my_server' => \URL::asset('')));
        } else {
            return response(array('status' => 2, 'message' => $message));
        }
    }

    public function saveBase64Image($image, $name, $dest)
    {
        //get the base-64 from data
        $base64_str = substr($image, strpos($image, ",") + 1);

        //decode base64 string
        $image = base64_decode($base64_str, true);
        $jpg_url = $name;
        $path = 'uploads/' . $dest . '/' . $jpg_url;

        $img = \Image::make($image);
        $result = $img->save($path);

        return $result;
    }

    public static function convetImageToBase64($image)
    {
        $type = pathinfo($image, PATHINFO_EXTENSION);
        $data = file_get_contents($image);
        return 'data:image/' . $type . ';base64,' . base64_encode($data);
    }

    public static function logAction($primaryValue, $Log_UserID, $Log_IPAddress, $Log_ActionName, $Log_AffectedRecordTableName, $Log_RecordReferenceName, $primary, $arr = [])
    {

        if (isset(self::$data["canLog"]) && self::$data["canLog"]) {
            $log = new LoggingMastersModel;
            $log->newMasterLog($primaryValue, $Log_UserID, $Log_IPAddress, $Log_ActionName, $Log_AffectedRecordTableName, $Log_RecordReferenceName, $primary);

            if (is_array($arr) && sizeof($arr)) {
                self::logActionDetails($log->Log_ID, $Log_AffectedRecordTableName, $arr);
            }
            return $log->Log_ID;
        }

        return 0;
    }

    public static function logActionDetails($LogDet_MasterID, $LogDet_ReferencedTableName, $arr)
    {
        if (isset(self::$data["canLog"]) && self::$data["canLog"] && self::$data["canLogDetails"]) {
            foreach ($arr as $key => $value) {
                if ($value["old"] != $value["new"]) {
                    $log = new LoggingDetailsModel;
                    $log->newDetailsLog($LogDet_MasterID, $LogDet_ReferencedTableName, $key, $value["old"], $value["new"]);
                }
            }
        }
    }

    public function exportFile($reportName, $table, $type = "xlsx", $chart = true, $custom = 0)
    {

        $chart = true;
        $ex = \Excel::create($reportName, function ($excel) use ($table, $reportName, $chart, $type) {
            $excel->sheet($reportName, function ($sheet) use ($table, $reportName, $type) {
                $sheet->setAllBorders('thin');
                $sheet->setAutoSize(true);

                $sheet->freezeFirstRow();
                //$sheet->setOrientation('landscape');

                $sheet->cells('A1:' . ($this->characters[sizeof($table['data'][0])]) . '1', function ($cells) {
                    $cells->setBackground('#f3f3f3');
                    $cells->setFontWeight('bold');
                });
                // Freeze first row
                $sheet->freezeFirstRow();
                $sheet->fromArray($table['data']);
                $sheet->prependRow();
                $sheet->mergeCells('A1:' . ($this->characters[sizeof($table['data'][0])]) . '1', "center");
                $sheet->cells('A1:' . ($this->characters[sizeof($table['data'][0])]) . '1', function ($cells) {
                    $cells->setBackground('#dddddd');
                    $cells->setFontWeight('bold');
                    $cells->setFontSize(20);
                });
                $sheet->row(1, array($reportName));


                if ($type == "pdf") {
                    $sheet->setAutoSize(false);

                    $sheet->setOrientation('landscape');

                }
                $sheet->getHeaderFooter()->setEvenFooter('&L&F Page &P / &N' . '&L&G&C User: ' . \Auth::user("admin")->SysUsr_FullName . '&L&G&R  date: ' . date('Y-m-d H:i:s'));
                $sheet->getHeaderFooter()->setoddFooter('&L&F Page &P / &N' . '&L&G&C User: ' . \Auth::user("admin")->SysUsr_FullName . '&L&G&R  date: ' . date('Y-m-d H:i:s'));
            });
        });

        $ex->export($type);
    }

    protected function formatAliasesold($data, $aliases)
    {
        $data = array_replace($aliases, $data);
        $final = ["draw" => $data["draw"], "recordsTotal" => $data["recordsTotal"], "recordsFiltered" => $data["recordsFiltered"], "data" => ""];
        $counter = 0;
        foreach ($data["data"] as $item) {
            $final["data"][$counter]["No"] = $counter + 1;
            foreach ($item as $key => $value) {
                if (isset($aliases[$key])) {
                    $final["data"][$counter][$aliases[$key]] = $value;
                }
            }

            ++$counter;
        }
        return $final;
    }

    protected function formatAliases($data, $aliases, $filter = 0)
    {

        //$data=array_replace($aliases, $data);
        $final = array("draw" => $data["draw"], "recordsTotal" => $data["recordsTotal"], "recordsFiltered" => $data["recordsFiltered"], "data" => "");
        $counter = 0;
        foreach ($data["data"] as $item) {
            $a[]=$item;

            $b=array($a[$counter]);
            $b["No"] = $counter + 1;
            $counter2 = 0;
            if ($filter != 0) {
                foreach ($a as $key => $value) {
                    if (in_array($counter2, $filter)) {
                        $b=array($a[$counter]);
                        $b[$key] = $value;
                    }
                    $counter2++;
                }
            } else {
                foreach ($item as $key => $value) {

                    $b=array($a[$counter]);
                    $b[$key] = $value;

                    $counter2++;
                }
            }

            ++$counter;
        }
        return $final;
    }

}
