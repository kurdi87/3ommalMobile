/*!
* 3ommal Web Application
* Questions Wizard
* author Ziad Ziadeh <ziadeh50@gmail.com>
*/
//##############################################################################################################################
//##################################################---Categories Data---#######################################################
//##############################################################################################################################


whatIsIdType = 'ما هو نوع بطاقة الهوية';

let categories =
    {
        workFields: {
            id: 'work_type',
            title: 'مجالات العمل',
            icon: 'logo',
            data: [

                {
                    name: 'work_fields',
                    val: 'حداد',
                    title: 'حداد',
                    icon: 'icon-maintenence',
                    page: whatIsIdType,
                    props: "setSelection(this)"
                }
            ]
        },



    }
