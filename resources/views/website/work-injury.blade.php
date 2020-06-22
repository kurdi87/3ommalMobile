<html lang="ar">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>3ommal Website</title>
    <meta name="description" content="" />
    <link
      rel="apple-touch-icon"
      sizes="180x180"
      href="./images/logo/logo-180x180.png"
    />
    <link
      rel="icon"
      type="image/png"
      sizes="32x32"
      href="./images/logo/logo-32x32.png"
    />
    <link
      rel="icon"
      type="image/png"
      sizes="16x16"
      href="./images/logo/logo-16x16.png"
    />
    <link rel="mask-icon" href="./images/logo/mask-icon.svg" color="#0e60ba" />
    <meta name="theme-color" content="#0e60ba" />
    <link rel="stylesheet" href="./css/style.css" type="text/css" />
  </head>
  <body>
    <div class="main">
      <div class="header">
        <div class="container">
          <div class="header-content-right"></div>
          <div class="header-content-center">
            أخبرنا عن إصابة عمل 
          </div>
          <div class="header-content-left">
            <a href="home.html"><i class="icon arrow-left"></i></a>
          </div>
        </div>
      </div>
      <div class="container">
        <form class="form"> 
          <div class="form-group">
            <label>تاريخ الإصابة</label>
            <div class="input-with-icon">
            <input
              type="date"
              class="form-control myDate"
            />
            <i class="icon icon-date"></i>
          </div>
          </div>
          <div class="form-group">
            <label>هل كنت تعمل عند نفس المشغل المذكور بالتصريح؟</label>
            <div class="multi-input">
              <div class="ck-button">
                <label>
                  <input type="radio" name="q" value="m" /><span>نعم</span>
                </label>
              </div>
              <div class="ck-button">
                <label>
                  <input type="radio" name="q" value="f" /><span>لا</span>
                </label>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label>هل حصلت على تلوش بنفس الشهر الذي حدثت به الإصابة</label>
            <div class="multi-input">
              <div class="ck-button">
                <label>
                  <input type="radio" name="w" value="m" /><span>نعم</span>
                </label>
              </div>
              <div class="ck-button">
                <label>
                  <input type="radio" name="w" value="f" /><span>لا</span>
                </label>
              </div>
            </div>
          </div>
           
          <div class="form-group">
            <label>إرفاق قسيمة الراتب </label>
            <div class="upload-btn-wrapper">
              <label class="btn"><i class="icon icon-upload"></i> اضغط لإرفاق الصورة</label>
              <input type="file" name="myfile" />
            </div> 
          </div> 

          <div class="form-footer text-center m-b-50">
            <a class="btn btn-primary w-50-perc m-t-20 btn-md modal-view" href="#" >حفظ البيانات</a>

            <div class="form-messages">
              <div class="form-message">
                يرجى تعبئة بياناتك في الصفحة الشخصية قبل حفظ الطلب
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>



    <div class="modal fade" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="box-container"> 
            <div class="box-content text-center">
              <p class="text-gray-dark m-t-b-20">شكراً لك</p>
              <p class="text-silver text-lighter">
                لقد تلقينا طلبك. سوف يتم الرد عليك قريبًا
              </p>
            </div>
            <div class="modal-confirm">
              <a class="btn btn-link modal-view" href="#">حسناً</a>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-backdrop"></div>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="./js/vendors/select-field.js"></script>
    <script src="./js/vendors/input-file.js"></script>
    <script src="./js/modal.js"></script>
    <script>
      document.querySelector(".myDate").valueAsDate = new Date();
    </script>
  </body>
</html>
