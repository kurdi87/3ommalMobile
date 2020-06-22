/*!
 * 3ommal Web Application
 * Questions Wizard
 * Author Ziad Ziadeh <ziadeh50@gmail.com>
 */
//##############################################################################################################################
//####################################################---Global Quations---#####################################################
//##############################################################################################################################
let jobInterviewQuestion =
  "بحيث تضمن العمل دون وساطات والحصول على مستحقات صمن عمل آمن, يرجى من حضرتك تعبئة البيانات التاليه بعد الموافقه بنعم";

let doYouhaveMagneticCard = "هل لديك بطاقة ممغنطة",
  palestinian = "فلسطينية",
  israeli = "اسرائيلية",
  dateOfYourLastWorkPermit = "ما هو تاريخ اخر تصريح عمل حصلت عليه",
  amountOfTheMonthlySalary = "ما هو مبلغ الراتب الشهري الذي تطمح بالحصول عليه",
  whatIsIdType = "ما هو نوع بطاقة الهوية",
  haveYouWorkedInsideGreenLine = "هل عملت سابقاً داخل الخط الأخضر",
  doYouHavevehicleLicense = "هل لديك رخصة مركبة",
  whatDateOfYourLastWorkPermit = "ما هو تاريخ اخر تصريح عمل حصلت عليه",
  doYouHavesecurityBanToEnterIsrael = "هل لديك منع أمني للدخول لإسرائيل",
  wereYouGettingASalarySlip = "هل كنت تحصل على قسيمة راتب (تلوش)",
  experiencedAPreviousWorkAccident =
    "هل تعرضت لحادث عمل سابقا اثناء عملك داخل الخط الأخضر",
  doYouHaveEndOfServiceBenefits =
    "هل لديك مستحقات نهاية خدمة من عمل داخل الخط الأخضر",
  whatIsTheMonthlySalaryAmountYouWereGetting =
    "ما هو مبلغ الراتب الشهر الذي كنت تحصل عليه مؤخرا من العمل داخل الخط الأخضر",
  haveYouTakenAPublicSafetyCourseAtWork =
    "هل حصلت على دورة السلامة العامة بالعمل",
  doYouSpeakHebrew = "هل تتحدث اللغة العبرية",
  YearsOfExperience = "عدد سنوات الخبرة",
  WhatIsTheLevelOfYourAcademicAchievement = "ما هو مستوى تحصيلك الاكاديمي";

//##############################################################################################################################
//###################################################---Translate Variables---##################################################
//##############################################################################################################################

let yearName = "السنة",
  monthName = "الشهر",
  yes = "نعم",
  no = "لا",
  yearsOfExperiencePlaceholder = "أدخل هنا عدد سنوات الخبرة",
  selectLevelPlaceholder = "اختر المستوى";
amountOfTheMonthlySalaryPlaceholder = "أدخل المبلغ هنا";

//##############################################################################################################################
//###################################################---Global Variables---#####################################################
//##############################################################################################################################

let question_id = "#question-",
  radio = "input[type=radio]",
  toSection = undefined,
  selectedValue = undefined,
  nationality = undefined,
  prevPage = undefined,
  pageFlow = [],
  currentDate = new Date(),
  currentYear = currentDate.getFullYear(),
  listYear = [],
  listMonth = [],
  levelOfAcademicList = [
    "شهادة مدرسية",
    "شهادة مهنية",
    "دبلوم",
    "بكالوريوس",
    "ماجستير",
  ],
  //#########---Popup message---############
  modal = {
    title: "شكراً لك",
    message: "لقد تلقينا طلبك. سوف يتم الرد عليك قريبًا",
    button: "حسناً",
    action: "onclick=closeModal()",
  };

for (i = 1990; i <= currentYear; i++) {
  listYear.unshift(i);
}

for (i = 1; i <= 12; i++) {
  listMonth.push(i);
}

//##############################################################################################################################
//###############################################---Handle Next Question---#####################################################
//##############################################################################################################################

function goTo(toQuestion, questionId) {
  if (!toQuestion) return;
  if (toQuestion === whatIsIdType) {
    $(".page-icon").show();
  }
  $(".steps li").each(function (index) {
    let title = $(this).text();
    let id = $(this).find("a").attr("id");
    title = title.replace("current step: ", "");
    let canPass = true;

    if (title === toQuestion) {
      if (questionId) {
        canPass = questionValidation(questionId);
        if (!canPass) {
          showMessage();
          return;
        }
      }

      prevPage = $("#wizard").steps("getCurrentStep").title;
      pageFlow.push(prevPage);
      $(`#${id}`)
        .get(0)
        .click();
    }
  });
}

function goToPrev() {
  let len = pageFlow.length - 1;
  let lastPage = pageFlow[len];
  goTo(lastPage);
  pageFlow.splice(len);
}

function goToPart(part, validate) {
  switch (part) {
    case "nationality":
      selectedValue = getSelectedValue("question-" + validate);
      if (!selectedValue) {
        showMessage();
        return;
      }
      selectedValue === palestinian
        ? (toSection = doYouhaveMagneticCard)
        : (toSection = doYouHavevehicleLicense);
      nationality = selectedValue;
      break;

    case "afterWorkedInsideGreenLine":
      selectedValue = getSelectedValue(validate);

      if (!selectedValue) {
        showMessage();
        return;
      }
      if (selectedValue === yes) {
        nationality === palestinian
          ? (toSection = dateOfYourLastWorkPermit)
          : (toSection = wereYouGettingASalarySlip);
      } else {
        nationality === palestinian
          ? (toSection = doYouHavesecurityBanToEnterIsrael)
          : (toSection = amountOfTheMonthlySalary);
      }
      break;

    case "afterDateOfLastWorkPermit":
      let workedInsideGreenLine = "worked_inside_green_line";
      workedInsideGreenLine = getSelectedValue(workedInsideGreenLine);

      workedInsideGreenLine === yes
        ? (toSection = wereYouGettingASalarySlip)
        : (toSection = amountOfTheMonthlySalary);
  }
  goTo(toSection, validate);
}

function setSelection(name, value) {
  if (!value) {
    $(name).find("input").attr("checked", "checked");
  } else {
    $("input[name=" + name + "][value='" + value + "']").attr(
      "checked",
      "checked"
    );
  }
}

function getSelectedValue(id) {
  return $(`#${id} input:checked`).val();
}

function questionValidation(questionId) {
  let valid = true,
    getVal = undefined,
    inputType = undefined;

  $(`#${questionId} :input`).each((idx, e) => {
    inputType = $(`#${questionId} :input`).eq(idx)[0].type;

    switch (inputType) {
      case "radio":
        if ($(`#${questionId}:not(:has(:radio:checked))`).length) {
          valid = false;
        }
        break;
      case "select-one":
        $(`#${questionId} select`)
          .children("option:selected")
          .each((i, ele) => {
            if (!ele.value) valid = false;
          });
        break;
      case "input":
      case "number":
      case "text":
        getVal = $(`#${questionId} input`).val();
        if (!getVal) {
          valid = false;
        }
        break;
    }
    if (!valid) return false;
  });

  return valid;
}

function showMessage() {
  $(".form-messages").fadeIn();
  setTimeout(() => {
    $(".form-messages").fadeOut();
  }, 2000);
}

function submitForm(questionId) {
  if (!questionId) return;
  canPass = questionValidation(questionId);
  if (!canPass) {
    showMessage();
    return;
  }

  console.log("######---Form---#####");
  console.log($("form").serializeArray());
  console.log("######---User Flow---#####");
  console.log(pageFlow);



  $.tmpl("modal-button", modal).appendTo("#modal");
  $(".modal").toggleClass("show");
}

function closeModal() {
  $(".modal").toggleClass("show");
  setTimeout(() => {
    window.location = "/index.html";
  }, 1000);
}

//##############################################################################################################################
//##############################################################################################################################
//##############################################################################################################################

$(document).ready(function () {
  //##############################################################################################################################
  //##################################################---Create Intro page---#####################################################
  //##############################################################################################################################
  let firstQuestion = {
    question: jobInterviewQuestion,
    id: "job_interview",
    template: "questionYesNo",
    values: {
      firstVal: yes,
      secondVal: no,
    },
  };
  $.tmpl("questionYesNo", firstQuestion).appendTo("#job_interview");

  //##############################################################################################################################
  //################################################---Handle Intro page click---#################################################
  //##############################################################################################################################
  $(document).on("change", question_id + "job_interview " + radio, function (
    e
  ) {
    let answer = e.target.value;
    setTimeout(() => {
      answer === yes
        ? $("#wizard-t-1").get(0).click()
        : (window.location = "../home.html");
    }, 250);
  });

  //##############################################################################################################################
  //###################################################---Questions Object---#####################################################
  //##############################################################################################################################

  let listOfQuestions = [
    //##############################################################################################################################
    {
      question: whatIsIdType,
      id: "id_type",
      template: "questionYesNo",
      values: {
        firstVal: palestinian,
        secondVal: israeli,
      },
      nav: {
        action: "goToPart",
        action_prop: "nationality",
        validate: "id_type",
        first: true,
      },
    },
    //##############################################################################################################################
    {
      question: doYouhaveMagneticCard,
      id: "magnetic_card",
      template: "questionYesNo",
      values: {
        firstVal: yes,
        secondVal: no,
      },
      nav: {
        action: "goTo",
        action_prop: haveYouWorkedInsideGreenLine,
        validate: "magnetic_card",
      },
    },
    //##############################################################################################################################
    {
      question: doYouHavevehicleLicense,
      id: "vehicle_license",
      template: "questionYesNo",
      values: {
        firstVal: yes,
        secondVal: no,
      },
      nav: {
        action: "goTo",
        action_prop: haveYouWorkedInsideGreenLine,
        validate: "vehicle_license",
      },
    },
    //##############################################################################################################################
    {
      question: haveYouWorkedInsideGreenLine,
      id: "worked_inside_green_line",
      template: "questionYesNo",
      values: {
        firstVal: yes,
        secondVal: no,
      },
      nav: {
        action: "goToPart",
        action_prop: "afterWorkedInsideGreenLine",
        validate: "worked_inside_green_line",
      },
    },
    //##############################################################################################################################
    {
      question: doYouHavesecurityBanToEnterIsrael,
      id: "security_ban_to_enter_israel",
      template: "questionYesNo",
      values: {
        firstVal: yes,
        secondVal: no,
      },
      nav: {
        action: "goTo",
        action_prop: whatDateOfYourLastWorkPermit,
        validate: "security_ban_to_enter_israel",
      },
    },
    //##############################################################################################################################
    {
      question: whatDateOfYourLastWorkPermit,
      id: "date_of_your_last_work_permit",
      template: "question-year-month",
      values: {
        yearName: "dateOfYourLastWorkPermit_Year",
        monthName: "dateOfYourLastWorkPermit_Month",
        listYear: listYear,
        listMonth: listMonth,
      },
      nav: {
        action: "goToPart",
        action_prop: "afterDateOfLastWorkPermit",
        validate: "date_of_your_last_work_permit",
      },
    },
    //##############################################################################################################################
    {
      question: amountOfTheMonthlySalary,
      id: "amount_of_the_monthly_salary",
      template: "question-input",
      values: {
        name: "amount_of_the_monthly_salary",
        placeholder: amountOfTheMonthlySalaryPlaceholder,
      },
      nav: {
        action: "goTo",
        action_prop: haveYouTakenAPublicSafetyCourseAtWork,
        validate: "amount_of_the_monthly_salary",
      },
    },
    //##############################################################################################################################
    {
      question: wereYouGettingASalarySlip,
      id: "getting_a_salary_slip",
      template: "questionYesNo",
      values: {
        firstVal: yes,
        secondVal: no,
      },
      nav: {
        action: "goTo",
        action_prop: experiencedAPreviousWorkAccident,
        validate: "getting_a_salary_slip",
      },
    },
    //##############################################################################################################################
    {
      question: experiencedAPreviousWorkAccident,
      id: "previous_work_accident",
      template: "questionYesNo",
      values: {
        firstVal: yes,
        secondVal: no,
      },
      nav: {
        action: "goTo",
        action_prop: doYouHaveEndOfServiceBenefits,
        validate: "previous_work_accident",
      },
    },
    //##############################################################################################################################
    {
      question: doYouHaveEndOfServiceBenefits,
      id: "end_of_service_benefits",
      template: "questionYesNo",
      values: {
        firstVal: yes,
        secondVal: no,
      },
      nav: {
        action: "goTo",
        action_prop: whatIsTheMonthlySalaryAmountYouWereGetting,
        validate: "end_of_service_benefits",
      },
    },
    //##############################################################################################################################
    {
      question: whatIsTheMonthlySalaryAmountYouWereGetting,
      id: "monthly_salary_amount_you_were_getting",
      template: "question-input",
      values: {
        name: "monthly_salary_amount_you_were_getting",
        placeholder: amountOfTheMonthlySalaryPlaceholder,
      },
      nav: {
        action: "goTo",
        action_prop: haveYouTakenAPublicSafetyCourseAtWork,
        validate: "monthly_salary_amount_you_were_getting",
      },
    },
    //##############################################################################################################################
    {
      question: haveYouTakenAPublicSafetyCourseAtWork,
      id: "taken_a_public_safety_course",
      template: "questionYesNo",
      values: {
        firstVal: yes,
        secondVal: no,
      },
      nav: {
        action: "goTo",
        action_prop: doYouSpeakHebrew,
        validate: "taken_a_public_safety_course",
      },
    },
    //##############################################################################################################################
    {
      question: doYouSpeakHebrew,
      id: "speak_hebrew",
      template: "questionYesNo",
      values: {
        firstVal: yes,
        secondVal: no,
      },
      nav: {
        action: "goTo",
        action_prop: YearsOfExperience,
        validate: "speak_hebrew",
      },
    },
    //##############################################################################################################################
    {
      question: YearsOfExperience,
      id: "years_of_experience",
      template: "question-input",
      values: {
        name: "years_of_experience",
        placeholder: yearsOfExperiencePlaceholder,
      },
      nav: {
        action: "goTo",
        action_prop: WhatIsTheLevelOfYourAcademicAchievement,
        validate: "years_of_experience",
      },
    },
    //##############################################################################################################################
    {
      question: WhatIsTheLevelOfYourAcademicAchievement,
      id: "level_of_your_academic",
      template: "question-select",
      values: {
        list: levelOfAcademicList,
        name: "level_of_your_academic",
        placeholder: selectLevelPlaceholder,
      },
      nav: {
        last: true,
        action: "submitForm",
        action_prop: "level_of_your_academic",
      },
    },
  ];

  let wizardLength = 0;

  //##############################################################################################################################
  //###################################################---Build Categories---#####################################################
  //##############################################################################################################################

  wizardLength = $(".steps ul li").length;

  $.each(categories, (idx, ele) => {
    $("#wizard").steps("insert", wizardLength, {
      title: ele.title,
      content: `<div id='${ele.id}'></div>`,
    });
    let template = {
      title: ele.title,
      icon: ele.icon,
      id: ele.id,
    };
    $.tmpl("category-section", template).appendTo(`#${ele.id}`);
    $.tmpl("link-icon", ele.data).appendTo(`#cat-${ele.id}`);

    wizardLength++;
  });

  //##############################################################################################################################
  //######################################################---Build Questions---###################################################
  //##############################################################################################################################

  //  wizardLength = $(".steps ul li").length;
  $.each(listOfQuestions, (idx, ele) => {
    $("#wizard").steps("insert", wizardLength, {
      title: ele.question,
      content: `<div id='${ele.id}'></div><div id='nav_${ele.id}'></div>`,
    });
    ele.nav.first ? "" : (ele.nav.first = false);
    ele.nav.last ? "" : (ele.nav.last = false);
    $.tmpl(ele.template, ele).appendTo(`#${ele.id}`);
    $.tmpl(
      ele.nav.template ? ele.nav.template : "question-nav",
      ele.nav
    ).appendTo(`#nav_${ele.id}`);

    wizardLength++;
  });

  $(".steps li").removeClass("disabled");
});
