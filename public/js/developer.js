var host = window.location.host;
var proto = window.location.protocol;
var ajax_url = proto+"//"+host+"/";
var ajax_form_url = proto+"//"+host;

    var arrayContains = Array.prototype.indexOf ?
    function(arr, val) {
        return arr.indexOf(val) > -1;
    } :
    function(arr, val) {
        var i = arr.length;
        while (i--) {
            if (arr[i] === val) {
                return true;
            }
        }
        return false;
    };

function logout(){
    localStorage.clear();
    window.location.href= ajax_url+'auth/logout';
}

function scrollbreak(){
    /*$( '.popup-messages' ).bind( 'mousewheel DOMMouseScroll', function ( e ) {
        var e0 = e.originalEvent,
            delta = e0.wheelDelta || -e0.detail;

        this.scrollTop += ( delta < 0 ? 1 : -1 ) * 30;
        e.preventDefault();
    });*/

}

function scrollToDown(){
    $( '.popup-messages' ).bind( 'mousewheel DOMMouseScroll', function ( e ) {
        var e0 = e.originalEvent,
            delta = e0.wheelDelta || -e0.detail;

        this.scrollTop += ( delta < 0 ? 1 : -1 ) * 30;
        e.preventDefault();
    });

}

function scrollbrek(){
    /*$( '.chat-sidebar' ).bind( 'mousewheel DOMMouseScroll', function ( e ) {
        var e0 = e.originalEvent,
            delta = e0.wheelDelta || -e0.detail;

        this.scrollTop += ( delta < 0 ? 1 : -1 ) * 30;
        e.preventDefault();
    });
  return false;*/
}


function arrayIntersection() {
    var val, arrayCount, firstArray, i, j, intersection = [], missing;
    var arrays = Array.prototype.slice.call(arguments); // Convert arguments into a real array

    // Search for common values
    firstArr = arrays.pop();
    if (firstArr) {
        j = firstArr.length;
        arrayCount = arrays.length;
        while (j--) {
            val = firstArr[j];
            missing = false;

            // Check val is present in each remaining array
            i = arrayCount;
            while (!missing && i--) {
                if ( !arrayContains(arrays[i], val) ) {
                    missing = true;
                }
            }
            if (!missing) {
                intersection.push(val);
            }
        }
    }
    return intersection;
}

var Refreshing = 0;
var EndOfDataTab1 = 0;
var EndOfDataTab2 = 0;
var EndOfDataTab3 = 0;
var NewSearchTab1 = 0;
var NewSearchTab2 = 0;
var NewSearchTab3 = 0;
var PageCountTab1 = 0;
var PageCountTab2 = 0;
var PageCountTab3 = 0;
var InputChanged = 0;
var OffsetCount=0;
var TabNum = 1;

function searchAndRefresh() {
    PageCountTab1 = PageCountTab2 = PageCountTab3 = EndOfDataTab1 = EndOfDataTab2 = EndOfDataTab3 = 0;
    NewSearchTab1 = NewSearchTab2 = NewSearchTab3 = InputChanged = 1;

    refreshData();
}

function refreshData() {
    var exchangeKeyword = $('#exchangeKeyword').val().toLowerCase().trim();
    var hostCountryC = $('#hostCountryC').val();
    var homeCountryC = $('#homeCountryC').val();
    var hostUniv = $('#hostUniv').val();
    var homeUniv = $('#homeUniv').val();

    var program = 2;
    if (!$('#all').is(':checked')) {
        if ($('#exchange').is(':checked')) {
            program = 0;
        } else if ($('#international').is(':checked')) {
            program = 1;
        } else {
            program = -1;
        }
    }

    var termFrom = $('#term_from').val();
    var termTo = $('#term_to').val();

    OffsetCount = 0;
    if (TabNum == 3) {
        if (EndOfDataTab3 == 1) {
            $("#loading_image").hide();
            return;
        }

        if (NewSearchTab3 == 0)  OffsetCount = PageCountTab3 += 10;
    } else if (TabNum == 2) {
        if (EndOfDataTab2 == 1) {
            $("#loading_image").hide();
            return;
        }

        if (NewSearchTab2==0)  OffsetCount = PageCountTab2 += 10;
    } else {
        if (EndOfDataTab1 == 1) {
            $("#loading_image").hide();
            return;
        }

        if (NewSearchTab1==0)  OffsetCount = PageCountTab1 += 10;
    }

    $("#loading_image").show();

    InputChanged = 0;

    $.get(location.pathname, { "tab": TabNum, "offset": OffsetCount, "homeUniv":homeUniv,"hostUniv":hostUniv,"exchangeKeyword":exchangeKeyword,"hostCountryC":hostCountryC, 'homeCountryC': homeCountryC, 'program': program, 'termFrom': termFrom, 'termTo': termTo}, function( data ) {
        Refreshing = 0;
        if (InputChanged == 1) return;

        if (data == '') {
            if (OffsetCount==0) data = "<div class='col-lg-12 noRecordFound'><p>There is currently no matching student in our community.</p><p>Please try another search, and help spread the word about our platform so that more people can benefit from it! :D</p></div>";
            else data = "<div class='col-lg-12 noRecordFound'><p>You have reached the end of the list.</p></div>";

            $("#loading_image").hide();

            switch (TabNum) {
                case 1:
                    EndOfDataTab1 = 1;
                    break;
                case 2:
                    EndOfDataTab2 = 1;
                    break;
                case 3:
                    EndOfDataTab3 = 1;
                    break;
                default:
                    break;
            }
        }

        switch (TabNum) {
            case 1:
                if (OffsetCount == 0) {
                    $("#listdatah").html(data);
                    NewSearchTab1 = 0;
                } else {
                    $("#listdatah").append(data);
                }
                break;
            case 2:
                if (OffsetCount == 0) {
                    $("#listdata").html(data);
                    NewSearchTab2 = 0;
                } else {
                    $("#listdata").append(data);
                }
                break;
            case 3:
                if (OffsetCount == 0) {
                    $("#listdata2").html(data);
                    NewSearchTab3 = 0;
                } else {
                    $("#listdata2").append(data);
                }
                break;
            default:
                break;
        }
    });
}

$(function(){

    $.arrayIntersect = function(a, b)
    {
        return $.grep(a, function(i)
        {
            return $.inArray(i, b) > -1;
        });
    };

    $(window).scroll(function()
    {
        if($(window).scrollTop() < 0)
        {
            $('#scc_ovrly_shw').css({'position':'absolute', 'top':'50px'});
            $('#err_ovrly_shw').css({'position':'absolute', 'top':'50px'});
        }
        else
        {
            $('#scc_ovrly_shw').css({'position':'fixed', 'top':'0px'});
            $('#err_ovrly_shw').css({'position':'fixed', 'top':'0px'});
        }
    });


    $("body").on('change','#homeUniv',function() {
        searchAndRefresh();
    });

    $("body").on('change','#hostUniv',function() {
        searchAndRefresh();
    });

    $("body").on('keyup','#exchangeKeyword',function() {
        searchAndRefresh();
    });
    $("body").on('change','#hostCountryC',function() {
        searchAndRefresh();
    });
    $("body").on('change','#homeCountryC',function() {
        searchAndRefresh();
    });

    $("body").on('keyup','#searchUNI',function(){
        serchUniversity();

    })

    $('#homeUniv').combobox();
    $('#hostUniv').combobox();
    $('#homeUniversityID').combobox();
    $('#hostUniversityID').combobox();
    $('#exchangeTerm').combobox();
    $('#homecountry').combobox();
    $('#hostNewcountry').combobox();
    $('#hostCountryC').combobox();
    $('#homeCountryC').combobox();
    $('#type').combobox();

    $("input[name='type']").on("change", function () {
        var typeVal = $(this).val();

        if (typeVal === undefined || typeVal === "") {

        } else {

            if(typeVal=='3' || typeVal=='4') {
                $('.type3-4').hide();
            }else {
                $('.type3-4').show();
                if($("input[name='hostUniversityID']").val()!='1') {
                    $('#newHostUniversityDiv').hide();
                }
            }
            //$(this).next('.input-group').find('input').focus();
        }
     });

     $("body").on("click",".glyphicon-remove",function(){

        if($(this).parents('.form-group').hasClass('home-univ')) {
            $('#newHomeUniversityDiv').hide();
        }else{

            $(this).parents('.form-group').next().find('#hostCountry').val('');
            $(this).parents('.form-group').next().next('#newHostUniversityDiv').hide();
            $(this).parents('.form-group').next('.hostCountryBlk').show();
        }
     });

     $("input[name='hostUniversityID']").on("change", function () {
        var hostUnivId = $(this).val();
        if (hostUnivId === undefined || hostUnivId === "") {
            $('#hostCountry').val("");
        } else {
            if(hostUnivId=='1') {
                $('#newHostUniversityDiv').show();
                $('.hostCountryBlk').hide();
            }else{
                $('#newHostUniversityDiv').hide();
                $('.hostCountryBlk').show();
                var token = $("input[name='_token']").val();
                var id = hostUnivId;
                $.ajax({
                   type:'post',
                    url: ajax_url+'university/getUniversityCountryName',
                    data: {"id": id, "_token": token},
                    dataType: 'json',
                    success:function (response) {
                        $('#hostCountry').val(response.data);
                    }

                });
            }

        }
     });


      $("input[name='homeUniversityID']").on("change", function () {
        var homeUnivId = $(this).val();

        if (homeUnivId === undefined || homeUnivId === "") {

        } else {
            if(homeUnivId=='1') {
                $('#newHomeUniversityDiv').show();
            }else{
                $('#newHomeUniversityDiv').hide();
            }

        }
     });

     // upload profile image
    if($('#uploadImage').length>0)
    {
        var token = $("input[name='_token']").val();
        var userID = $('#uploadImage').attr('data-rel');
        myaction = ajax_url+'users/uploadImage';
        var btnUpload=$('#uploadImage');
        var curImgSrc = $("#uploadImage").children('img').attr('src');
        var loadingImgSrc = ajax_url+'img/loader.gif';
        new AjaxUpload(btnUpload, {
            action: myaction,
            name: 'uploadfile',
            data: {"userId": userID, "_token": token},
            onSubmit: function(file, ext)
            {

                $("#uploadImage").children('img').attr('src',loadingImgSrc);
                $("#uploadImage").children('img').addClass('centerLoader');
                if (! (ext && /^(jpg|png|jpeg|gif)$/.test(ext)))
                 {
                    // extension is not allowed
                    showError("Only JPG, PNG, or GIF files are allowed", 5000);
                    //alert("Only JPG, PNG, or GIF files are allowed");
                    $("#uploadImage").children('img').removeClass('centerLoader');
                    $("#uploadImage").children('img').attr('src',curImgSrc);
                    return false;
                } else if (this._input.files[0].size > 2097152) { //10MB 10485760
                    //show alert message
                    showError("Selected file should be smaller than 2MB.", 5000);
                    //alert('Selected file should be smaller than 10MB.');
                    return false;
                }
            },
            onComplete: function(file, response)
            {

                //Add uploaded file to list
                html=response.split(":");
                if($.trim(html[0])==="success")
                {
                    overlayMessageShow('success','Profile image has been successfully uploaded.');
                    //$("#uploadImage").attr('src',ajax_url+'img/Front/memberImages/'+html[1]);
                    window.location.reload()

                }

                else
                {
                    overlayMessageShow('error','An error occurred while uploading.\r\n'+html[1]);
                    $("#uploadImage").children('img').removeClass('centerLoader');
                    $("#uploadImage").children('img').attr('src',curImgSrc);
                }
            }
        });
    }

});

function rightTxt(param){
     $('#rightText').html(param);
 }


function overlayShow()
{
    $('#loading_overlay').show();
    $('#loading_overlay').children().show();
}
function overlayHide()
{
    $('#loading_overlay').hide();
    $('#loading_overlay').children().hide();
}
function ScrollToTop(el) {
     $( "html, body" ).animate({
        scrollTop: 0,
        });

}
// custom message
function overlayMessageShow(msgType, msg)
{
    if(msgType == 'success')
    {
        $('#custom_success_client').html(msg);
        $('#custom_success_client').show();
    }
    else if(msgType == 'error')
    {
        $('#custom_error_client').html(msg);
        $('#custom_error_client').show();
    }
}

function serchUniversity(){
    var counter = 0;
    var tempArr = new Array();
    universityName=$('#searchUNI').val().toLowerCase();
    $( ".unicheck" ).each(function() {
        $(this).hide();
        object = $(this);
        if(universityName!='') {
            counter = counter+1;
            /* Host filter */
            var destinationUniv = object.attr( "data-university");
            universityName = universityName.replace('(','');
            universityName = universityName.replace(')','');
            var reEk = new RegExp(universityName);
            if (destinationUniv.match(reEk)) {
                tempArr.push(object.attr('id'));
            }
        }
    });
    var tempFinalArray = new Array();
    if(tempArr.length>0){
        tempFinalArray = $.merge( tempFinalArray, tempArr );
    }
    if(tempArr.length>0){
        var sorted_arr = tempFinalArray.sort();
        var results = [];
        if(tempFinalArray.length>1){
            for (var i = 0; i < tempFinalArray.length - 1; i++) {
                if (sorted_arr[i + 1] == sorted_arr[i]) {
                    results.push(sorted_arr[i]);
                }
            }
        } else {
            results.push(sorted_arr[0]);
        }
    } else {
        var results = tempFinalArray;
    }
    $.each(tempFinalArray,function(e){
        $('#'+tempFinalArray[e]).show();
    });
    if (!counter) {
        $(".unicheck").show();
    }
}

function validateSubscriber() {
    var form = $("#about_sub_form");

    form.validate();

    if(form.valid()) {
        var formAction = form.attr('action');
        var email = $("#email");
        var token = $("input[name='_token']");
        var emailValue = email.val();
        var tokenValue = token.val();
        var subscriberMessageBoxDivID = "#subscriberMessageBox";
        $.ajax({
            type: "post",
            url: formAction,
            data: {"email": emailValue, "_token": tokenValue},
            dataType: 'json',
            success: function (response, textStatus, jqXHR) {
                //remove existing error classes and error messages from form groups
                if (response.success) {
                    overlayMessageShow('success',response.data);
                } else {
                    overlayMessageShow('error',response.data);
                }

            },
            error: function (response) {
                var errors = JSON.parse(response.responseText);
                if (response.status === 422) {
                    associate_errors(errors, form);
                }
            }
        });
    }
    return false;
}
function associate_errors(errors, $form) {
    //remove existing error classes and error messages from form groups
    $form.find('.form-group').removeClass('has-feedback').removeClass('has-error').find('.help-block').text('');
    //$form.find('.form-group').find('.glyphicon').removeClass('glyphicon-remove');
    $form.find("#subscribeBtn").removeClass('btn-danger').addClass('btn-default');
    $form.find("#subscribeBtn").css('border-color', "#ccc");
    for (var key in errors) {
        //find each form group, which is given a unique id based on the form field's name
//                var $group = $form.find('#' + key + '-group');
        var $group = $form.find('#' + key);
        //$group.parent().parent().append('<span style="margin-right:6em;" class="glyphicon form-control-feedback glyphicon-remove"></span>');
        var $msg = $form.find('.' + key + '-form-group').append('<span class="help-block"> </span>');
        //add the error class and set the error text
        $msg.addClass('has-feedback').addClass('has-error').find('.help-block').text(errors[key]);
        //$form.find("#subscribeBtn").removeClass('btn-default').addClass('btn-danger');
        $form.find("#subscribeBtn").css('border-color', "#a94442");
    }
}

function sendRequest(obj) {

    var UID = $('#uId').val();
    var TOID = $('#toId').val();
    var REQTYPE = $('#reqType').val();

    var MESSAGE = $('#message').val();

    $('#requestForm').validate();
    if($('#requestForm').valid()) {
            $(obj).text('Processing...');
            $(obj).attr('onclick','');
            if(TOID!='' && UID!='') {
            var frm = $('#requestForm');

            var formAction = frm.attr('action');

            var token = frm.find("input[name='_token']");

            var tokenValue = token.val();
            var subscriberMessageBoxDivID = "#subscriberMessageBox";
            $.ajax({
                type: "post",
                url: formAction,
                data: {"reqType": REQTYPE,"toId": TOID,"uId": UID,"message": MESSAGE, "_token": tokenValue},
                dataType: 'json',
                success: function (response, textStatus, jqXHR) {
                    //remove existing error classes and error messages from form groups
                    if (response.success) {
                        overlayMessageShow('success',response.data);
                    } else {
                        overlayMessageShow('error',response.data);
                    }
                    $(obj).text('Submit');
                    $(obj).attr('onclick','return sendRequest(this);');
                    $('.closeModal').trigger('click');
                },
                error: function (response) {
                    var errors = JSON.parse(response.responseText);
                    if (response.status === 422) {
                        associate_errors(errors, form);
                    }
                }
            });
        }else {
            alert('Some problem occur. Please try again!');return false;
        }
    }

    return false;
}

function loggedinUser(){
    alert('You are not able to Chat!');
    return false;
}

function filterByCountry(){
    var country = $("#combobox-countrylist").val();
    if (country == null) {
        country = 'all';
    }
    var frm = $('#CntrySlct');
    var formAction = frm.attr('action');
    var token = frm.find("input[name='_token']");
    var tokenValue = token.val();
    $('#universityList').addClass('customOpacity');
    $.ajax({
        type: "post",
        url: formAction,
        data: {"country":country, "_token": tokenValue},
        dataType: 'json',
        success: function (response, textStatus, jqXHR) {
            if (response.success) {
                if(response.countData >= 0) {
                    var objects = JSON.stringify(response.data);
                    var image='';
                    var university = '';
                    var universityname='';
                    $.each(response.data, function(key, item) {
                        universityname=item.universityName
                        university += '<div id="gridId'+item.id+'" class="col-lg-3 col-md-3 col-sm-3 col-xs-12 unicheck"  data-university="'+universityname.toLowerCase()+'">\
                        <div class="inner_university_blck">';
                        if (item.image != "") {
                            image = '<img src='+ajax_url+'images/universities/' + item.image+ ' />';
                        } else {
                            image = '<img src='+ajax_url+'img/Sogang_University.gif />';
                        }
                        university += image;
                        university += '<div class="inner_img_block">\
                        <h4> <a href="/university-detail/' + item.id + '/university"> ' + item.universityName + '</a></h4>\
                        </div>\
                        </div>\
                        </div>';
                    });
                    $('#universityList').html(university);
                } else {
                    $("#universityList").html("<div class=\"col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center\"><span class=\"noFound\">No record found!</span></div>");
                }
            } else {
                $("#universityList").html("<div class=\"col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center\"><span class=\"noFound\">No record found!</span></div>");
            }
            $('#universityList').removeClass('customOpacity');
        },
        error: function (response) {
            var errors = JSON.parse(response.responseText);
            if (response.status === 422) {
                associate_errors(errors, form);
            }
        }
    });
}

$(document).ready(function(){
    $('#CntrySlct').bind("keypress", function (e) {
        if (e.keyCode == 13) {
            $("#btnSearch").attr('value');
            return false;
        }
    });

     $('input[type=radio][name=program_exp]').change(function() {
        if (this.value == 'EXCHANGE') {
            $("#host_uni_exp_ex").show();
            $("#host_uni_exp_ft").hide();
            $("#host_cnt_exp_ft").hide();
            $("#host_cnt_exp_ex").show();
        }
        else if (this.value == 'FULL-TIME') {
            $("#host_uni_exp_ex").hide();
            $("#host_uni_exp_ft").show();
            $("#host_cnt_exp_ft").show();
            $("#host_cnt_exp_ex").hide();
        }
    });

    $("input[name=homeUniversityID]").change(function(){
        if ($(this).val() == '1') {
            $("#newHomeUniversityDiv input").attr("required","required");
        } else {
            $("#newHomeUniversityDiv input").removeAttr("required");
        }
    });

    $("input[name=hostUniversityID]").change(function(){
        if ($(this).val() == '1') {
            $("#newHostUniversityDiv input").attr("required","required");
        } else {
            $("#newHostUniversityDiv input").removeAttr("required");
        }
    });

    $("input#password").change(function(){
        if ($(this).val() != "") {
        $(this).attr("required","required");
        } else {
        $(this).removeAttr("required");
        }
    });

    $(".back_purpose").click(function(e){
        e.preventDefault();
        $("#purpose_field").attr("value", 0);
        $("#purpose_options").show();
        $("#further_details").hide();
        $("#further_details").find("input").removeAttr("required");
     });

$.validator.addMethod("checkdate", function (value,element) {
        if ($(element).is(':visible')) {
            // var date1 = moment($("#term_from").val()).format('YYYY-MM-DD');

            // var date2 = moment($("#term_to").val()).format('YYYY-MM-DD');
            var date1 = moment($("#term_from").val(), 'MMM-YYYY');
            var date2 = moment($("#term_to").val(), 'MMM-YYYY');

            if(date2 <= date1)
              return false;
            else
              return true;
        } else {
            return true;
        }
    }, 'School Term is not valid');

        $('#term_from').datepicker({
        format: 'M yyyy',
        startView: "months",
        minViewMode: "months"
        });

        $('#term_to').datepicker({
        format: 'M yyyy',
        startView: "months",
        minViewMode: "months"
        });

        $('#general_profile').validate({
        ignore: [],
        rules: {
                password: {
                    minlength: 6
                },
        term_to:{
          checkdate:true
        }
            }
    });

    $(".purpose").click(function(){
        $("#further_details").find("input").removeAttr("required");
        $(".purpose_selected").removeClass("purpose_selected");
        if ($("input[name=hostUniversityID]").val() == "1") {
            $("input[name=hostUniversityID]").next().find(".glyphicon-remove").click();
        }
        switch($(this).attr("id")) {
            case "onlooker":
                $("#purpose_field").attr("value", 4);
                $("#onlooker > .purpose_images").addClass("purpose_selected");
                //$("#purpose_options").hide();
                $("#further_details").show();
                $("#experienced").hide().find("input").removeAttr("required");
                $("#newbies").show().find("input").attr("required","required");
                $("#program_undecided").hide().find("input").removeAttr("required");
                break;
            case "undecided":
                $("#purpose_field").attr("value", 3);
                $("#undecided > .purpose_images").addClass("purpose_selected");
                //$("#purpose_options").hide();
                $("#further_details").show();
                $("#experienced").hide().find("input").removeAttr("required");
                $("#newbies").show().find("input").attr("required","required");
                $("#program_undecided").show().find("input").attr("required","required");
                break;
            case "adventurer":
                $("#purpose_field").attr("value", 1);
                $("#adventurer > .purpose_images").addClass("purpose_selected");
                //$("#purpose_options").hide();
                $("#further_details").show();
                $("#newbies").hide().find("input").removeAttr("required");
                $("#experienced").show().find("input:not(#newHostUniversityDiv input, #hostCountry)").attr("required","required");
                $('.type3-4').show();
                break;
            case "senior":
                $("#purpose_field").attr("value", 2);
                $("#senior > .purpose_images").addClass("purpose_selected");
                //$("#purpose_options").hide();
                $("#further_details").show();
                $("#experienced").show().find("input:not(#newHostUniversityDiv input, #hostCountry)").attr("required","required");
                $("#newbies").hide().find("input").removeAttr("required");
                $('.type3-4').show();
                break;
            default:
                break;
        }
    });

    // Name: Twisha Mankad
    // Purpose: To provide filter for promotional data
    // Date: 07/10/2016

    $("#FilterSelectDisc").change(function(){
        var filter=$(this).val();
        if(filter!="all")
        {
            $("#Container").each(function(){
                $("div.filter_selection").not("."+filter).hide();
                $("div."+filter).show();
            });
        } else {

                $("#Container").each(function(){
                $("div.filter_selection").show();
            });
        }

    });

    // Name: Twisha Mankad
    // Purpose: To provide tooltips for different types of users
    // Date: 19/10/2016

    $("#purpose_options img").tooltip();

    function openLoginOverlay() {
    document.getElementById("login-overlay").style.width = "100%";
}

    function closeLoginOverlay() {
        document.getElementById("login-overlay").style.width = "0%";
    }

    $("button.close-overlay").click( function(){
        closeLoginOverlay();
      });

    $("button.promocode").click( function(){
        if ($(this).next().is(".title")) {
            $(this).next().show();
         $(this).hide();
        } else {
        openLoginOverlay();
        }
      });


    $("ul.nav-tabs li").click(function() {
        if ($(this).hasClass("active")) return;
        TabNum = $(this).index() + 1;

        switch (TabNum) {
            case 1:
                $('#type-label').show();
                $('input[name=program]').parent().parent().show();
                $('#term').show();
                $('.tab-3-display').hide();
                $('.tab-3-hidden').show();
                $('#host-filters').after($('#home-filters'));
                break;
            case 2:
                $('#type-label').show();
                $('input[name=program]').parent().parent().show();
                $('#term').hide();
                $('.tab-3-display').hide();
                $('.tab-3-hidden').show();
                $('#host-filters').after($('#home-filters'));
                break;
            case 3:
                $('#type-label').hide();
                $('input[name=program]').parent().parent().hide();
                $('#term').hide();
                $('.tab-3-display').show();
                $('.tab-3-hidden').hide();
                $('#host-filters').before($('#home-filters'));
                break;
            default:
                break;
        }

        refreshData();
    });

    $('input[name=program]').change(function () {
        searchAndRefresh();
    });

    $('input[name=term_from]').change(function () {
        searchAndRefresh();
    });

    $('input[name=term_to]').change(function () {
        searchAndRefresh();
    });
});
