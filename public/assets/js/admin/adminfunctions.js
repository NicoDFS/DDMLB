var admin = {

    init : function(options){
        this.currentUrl  = options.currentUrl;
			
    },
    themesactive : function(){
        
        var themes = $(this).attr('id');
        var themesid= themes.replace("themes_","");
        var w = $(this);
        $.ajax({
        
            url: admin.currentUrl,
            type: 'POST',
            datatype: 'HTML',
            data:{
                method : 'themesactive',
                themesid : themesid
            },
            beforeSend : function() {

            },
            success : function(response) { 
                              
                $('#'+"activeclass_"+response).removeClass('label label-block label-primary');
                $('#'+"activeclass_"+response).addClass('label label-block label-inverse');
                $('#'+"activeclass_"+response).html("Deactivate");
                $('#themes_'+response).removeClass('themesactive');
                $('#themes_'+response).addClass('themesdeactive');
                $('#'+"activemenu_"+response).html("Active");       
                top.location.href = 'themes';
            }
            
        
        });
        
        
    },
    themesdeactive : function(){
       
        var themes = $(this).attr('id');
        var themesid= themes.replace("themes_","");
        var w = $(this);
        $.ajax({
        
            url: admin.currentUrl,
            type: 'POST',
            datatype: 'HTML',
            data:{
                method : 'themesdeactive',
                themesid : themesid
            },
            beforeSend : function() {

            },
            success : function(response) {  
                $('#'+"activeclass_"+response).removeClass('label label-block label-inverse');
                $('#'+"activeclass_"+response).addClass('label label-block label-primary');
                $('#'+"activeclass_"+response).html("Activate");
                $('#themes_'+response).removeClass('themesdeactive');
                $('#themes_'+response).addClass('themesactive');
                $('#'+"activemenu_"+response).html("Deactivate");   
                top.location.href = 'themes';
            }
            
        
        });
        
        
    },
    userdeactive : function(){ 
        var user = $(this).attr('id');
        var userid = user.replace("users_","");        
        var w = $(this);        
        $.ajax({
        
            url: admin.currentUrl,
            type: 'POST',
            datatype: 'HTML',
            data:{
                method : 'useractive',
                userid : userid
            },
            beforeSend : function() {

            },
            success : function(response) {                  
                $('#'+"activeclass_"+response).removeClass('label label-block label-inverse');
                $('#'+"activeclass_"+response).addClass('label label-block label-primary');
                $('#'+"activeclass_"+response).html("Activate");
                $('#users_'+response).removeClass('usersdeactive');
                $('#users_'+response).addClass('usersactive');
                $('#'+"activeuser_"+response).html("Suspended");
            }
            
        
        });
        
        
    },
    approvalactive : function(){
        var withdraw = $(this).attr('id');
        var wid = withdraw.replace("withdrawapr_","");        
        var w = $(this);        
        $.ajax({
        
            url: admin.currentUrl,
            type: 'POST',
            datatype: 'HTML',
            data:{
                method : 'approvalactive',
                withdrawid : wid
            },
            beforeSend : function() {

            },
            success : function(response) {                  
                $('#'+"activewithdraw_"+response).css("display","none");
                $('#'+"withdrawapr_"+response).css("display","none");
                $('#'+"activeapr_"+response).html("Approved");
            }
            
        
        });
        
        
    },
    useractive : function(){
        var user = $(this).attr('id');
        var userid = user.replace("users_","");        
        var w = $(this);
        $.ajax({
        
            url: admin.currentUrl,
            type: 'POST',
            datatype: 'HTML',
            data:{
                method : 'useractive',
                userid : userid
            },
            beforeSend : function() {

            },
            success : function(response) {                 
                $('#'+"activeclass_"+response).removeClass('label label-block label-primary').addClass('label label-block label-inverse');
                //$('#'+"activeclass_"+response).;
                $('#'+"activeclass_"+response).html("Deactivate");
                $('#users_'+response).removeClass('usersactive');
                $('#users_'+response).addClass('usersdeactive');
                $('#'+"activeuser_"+response).html("Active");
            }
            
        
        });
        
        
    },
    deleteuser : function(){
        var user = $(this).attr('id');
        var userid= user.replace("userdelete_","");
        var w = $(this);
        bootbox.confirm("Do you want to Delete this  user?", function(result)
        {
            if(result){
                $.ajax({
        
                    url: admin.currentUrl,
                    type: 'POST',
                    datatype: 'HTML',
                    data:{
                        method : 'userdelete',
                        userid : userid
                    },
                    beforeSend : function() {

                    },
                    success : function(response) {
                
                        w.parent().parent().remove(); 

                    }
            
        
                });
            }
        });
        
        
    },
    countrydeactive : function(){
        var country = $(this).attr('id');
        var country_id = country.replace("country_","");        
        var w = $(this);        
        $.ajax({
        
            url: admin.currentUrl,
            type: 'POST',
            datatype: 'HTML',
            data:{
                method : 'countryactive',
                country_id : country_id
            },
            beforeSend : function() {

            },
            success : function(response) {                  
                $('#'+"activeclass_"+response).removeClass('label label-block label-inverse');
                $('#'+"activeclass_"+response).addClass('label label-block label-primary');
                $('#'+"activeclass_"+response).html("Activate");
                $('#country_'+response).removeClass('countrydeactive');
                $('#country_'+response).addClass('countryactive');
                $('#'+"activecountry_"+response).html("Suspended");
            }
            
        
        });
        
        
    },
    countryactive : function(){
        var country = $(this).attr('id');
        var country_id = country.replace("country_","");                
        var w = $(this);        
        $.ajax({
        
            url: admin.currentUrl,
            type: 'POST',
            datatype: 'HTML',
            data:{
                method : 'countryactive',
                country_id : country_id
            },
            beforeSend : function() {

            },
            success : function(response) {               
                $('#'+"activeclass_"+response).removeClass('label label-block label-primary');
                $('#'+"activeclass_"+response).addClass('label label-block label-inverse');
                $('#'+"activeclass_"+response).html("Deactivate");
                $('#country_'+response).removeClass('countryactive');
                $('#country_'+response).addClass('countrydeactive');
                $('#'+"activecountry_"+response).html("Active");
            }
            
        
        });
        
        
    },
	
    deletecountry : function(){
        var country = $(this).attr('id');
        var country_id= country.replace("countrydelete_","");
        var w = $(this);
        bootbox.confirm("Do you want to Delete this  Country?", function(result)
        {
            if(result){
                $.ajax({
        
                    url: admin.currentUrl,
                    type: 'POST',
                    datatype: 'HTML',
                    data:{
                        method : 'countrydelete',
                        country_id : country_id
                    },
                    beforeSend : function() {

                    },
                    success : function(response) {
                
                        w.parent().parent().remove(); 

                    }
            
        
                });
            }
        });
        
        
    },
    withdrawalapproval : function(){
        var withdrawal = $(this).attr('id');
        var withdrawal_id = withdrawal.replace("withdrawal_","");                
        var w = $(this);        
        $.ajax({
        
            url: admin.currentUrl,
            type: 'POST',
            datatype: 'HTML',
            data:{
                method : 'withdrawalApproval',
                withdrawal_id : withdrawal_id
            },
            beforeSend : function() {

            },
            success : function(response) {               
                w.parent().parent().remove();
            }
            
        
        });
        
        
    },
    deletecontest : function(){
        var contest = $(this).attr('id');     
        var contestid= contest.replace("contestdelete_","");           
        var w = $(this);
        bootbox.confirm("Do you want to Delete this contest?", function(result)
        {
            if(result){
                $.ajax({
        
                    url: admin.currentUrl,
                    type: 'POST',
                    datatype: 'HTML',
                    data:{
                        method : 'contestdelete',
                        contestid : contestid
                    },
                    beforeSend : function() {

                    },
                    success : function(response) {
                
                        w.parent().parent().remove(); 

                    }
            
        
                });
            }
        });
        
        
    },
    updatecontest : function(){ 
       
        var contest = $(this).attr('id');
        var contestid = contest.replace("contestupdate_","");
        var w = $(this);
        bootbox.confirm("Do you want to Featured this contest?", function(result)
        {
            if(result){
                $.ajax({
                  
                    url : '/admin/settings/jshandler',
                    type : 'POST',
                    datatype : 'HTML',
                    data :{
                        method : 'contestsupdate',
                        contestid : contestid
                    },
                    beforeSend : function(){
                      
                    },
                    success : function(response){
                        w.parent().parent().remove(); 
                    }  
                });
          
            }
              
        });
    },

    
    deletecontestype : function(){
        var contest = $(this).attr('id');     
        var contestid= contest.replace("contestType_","");           
        var w = $(this);
        bootbox.confirm("Do you want to Delete this contest type?", function(result)
        {
            if(result){
                $.ajax({
        
                    url: admin.currentUrl,
                    type: 'POST',
                    datatype: 'HTML',
                    data:{
                        method : 'contestypedelete',
                        contestid : contestid
                    },
                    beforeSend : function() {

                    },
                    success : function(response) {
                
                        w.parent().parent().remove(); 

                    }
            
        
                });
            }
        });
        
        
    },
    deletegame : function(){
        var game = $(this).attr('id');     
        var gameid = game.replace("gameDelete_","");           
        var w = $(this);
        bootbox.confirm("Do you want to Delete this Game?", function(result)
        {
            if(result){
                $.ajax({
        
                    url: admin.currentUrl,
                    type: 'POST',
                    datatype: 'HTML',
                    data:{
                        method : 'gamedelete',
                        gameid : gameid
                    },
                    beforeSend : function() {

                    },
                    success : function(response) {
                
                        w.parent().parent().remove(); 

                    }
            
        
                });
            }
        });
        
        
    },
    gamedeactive : function(){
        var game = $(this).attr('id');
        var game_id = game.replace("game_","");        
        var w = $(this);        
        $.ajax({
        
            url: admin.currentUrl,
            type: 'POST',
            datatype: 'HTML',
            data:{
                method : 'gameactive',
                game_id : game_id
            },
            beforeSend : function() {

            },
            success : function(response) {                  
                $('#'+"activeclass_"+response).removeClass('label label-block label-inverse');
                $('#'+"activeclass_"+response).addClass('label label-block label-primary');
                $('#'+"activeclass_"+response).html("Activate");
                $('#game_'+response).removeClass('gamedeactive');
                $('#game_'+response).addClass('gameactive');
                $('#'+"activegame_"+response).html("Suspended");
            }
            
        
        });
        
        
    },
    gameactive : function(){
        var game = $(this).attr('id');
        var game_id = game.replace("game_","");                
        var w = $(this);        
        $.ajax({
        
            url: admin.currentUrl,
            type: 'POST',
            datatype: 'HTML',
            data:{
                method : 'gameactive',
                game_id : game_id
            },
            beforeSend : function() {

            },
            success : function(response) {               
                $('#'+"activeclass_"+response).removeClass('label label-block label-primary');
                $('#'+"activeclass_"+response).addClass('label label-block label-inverse');
                $('#'+"activeclass_"+response).html("Deactivate");
                $('#game_'+response).removeClass('gameactive');
                $('#game_'+response).addClass('gamedeactive');
                $('#'+"activegame_"+response).html("Active");
            }
            
        
        });
        
        
    },
    contestdeactive : function(e){
        e.preventDefault();
        var contest = $(this).attr('id');
        var contest_id = contest.replace("contest_","");        
        var w = $(this);   
        console.log('deactivate called');
        $.ajax({
        
            url: admin.currentUrl,
            type: 'POST',
            datatype: 'HTML',
            data:{
                method : 'contestactive',
                contest_id : contest_id
            },
            beforeSend : function() {

            },
            success : function(response) {                  
                $('#'+"activeclass_"+response).removeClass('label label-block label-inverse');
                $('#'+"activeclass_"+response).addClass('label label-block label-primary');
                $('#'+"activeclass_"+response).html("Activate");
                $('#contest_'+response).removeClass('contestdeactive');
                $('#contest_'+response).addClass('contestactive');
                $('#'+"activecontest_"+response).html("Suspended");
            }
            
        
        });
        
        
    },
    contestactive : function(e){
        e.preventDefault();
        var contest = $(this).attr('id');
        var contest_id = contest.replace("contest_","");          
        var w = $(this);    
        console.log('activate called');
        $.ajax({
        
            url: admin.currentUrl,
            type: 'POST',
            datatype: 'HTML',
            data:{
                method : 'contestactive',
                contest_id : contest_id
            },
            beforeSend : function() {

            },
            success : function(response) {               
                $('#'+"activeclass_"+response).removeClass('label label-block label-primary');
                $('#'+"activeclass_"+response).addClass('label label-block label-inverse');
                $('#'+"activeclass_"+response).html("Deactivate");
                console.log(response);
                $('#contest_'+response).removeClass('contestactive');
                $('#contest_'+response).addClass('contestdeactive');
                //                $('#contest_'+response).removeClass('contestdeactive');
                //                $('#contest_'+response).addClass('contestactive');
                //contestdeactive
                $('#'+"activecontest_"+response).html("Active");
            }
            
        
        });
        
        
    },
    
    offeractive : function(){ 
        var offers = $(this).attr('id');
        console.log(offers);
        var offersid= offers.replace("offers_","");
        
        var w = $(this);
        //        alert(w);
        $.ajax({
        
            url: admin.currentUrl,
            type: 'POST',
            datatype: 'HTML',
            data:{
                method : 'offeractive',
                offersid : offersid
            },
            beforeSend : function() {

            },
            success : function(response) { 
                var id = parseInt(response);
              
                if($.isNumeric(id)){
                    //                    alert('number');
                    $('#'+"activeclass_"+response).removeClass('label label-block label-primary');
                    $('#'+"activeclass_"+response).addClass('label label-block label-inverse');
                    $('#'+"activeclass_"+response).html("Deactivate");
                    $('#offers_'+response).removeClass('offersactive');
                    $('#offers_'+response).addClass('offersdeactive');
                    $('#'+"activemenu_"+response).html("Active");
                }else{
                    //                  alert('not number');
                    //                  $('#'+"activeclass_"+response).removeClass('label label-block label-primary');
                    //                    $('#'+"activeclass_"+response).addClass('label label-block label-inverse');
                    //                    $('#'+"activeclass_"+response).html("Deactivate");
                    //                    $('#offers_'+response).removeClass('offersactive');
                    //                    $('#offers_'+response).addClass('offersdeactive');
                    //                    $('#'+"activemenu_"+response).html("Active");       
                    //                    top.location.href = 'offers';
                  
                    $("#error").html(response);
                }
               
            }
        });
    },
    
    offerdeactive : function(){ 
       
        var offers = $(this).attr('id');
        var offersid= offers.replace("offers_","");
        var w = $(this);
        $.ajax({
        
            url: admin.currentUrl,
            type: 'POST',
            datatype: 'HTML',
            data:{
                method : 'offerdeactive',
                offersid : offersid
            },
            beforeSend : function() {

            },
            success : function(response) {  
                $('#'+"activeclass_"+response).removeClass('label label-block label-inverse');
                $('#'+"activeclass_"+response).addClass('label label-block label-primary');
                $('#'+"activeclass_"+response).html("Activate");
                $('#offers_'+response).removeClass('offersdeactive');
                $('#offers_'+response).addClass('offersactive');
                $('#'+"activemenu_"+response).html("Deactivate");
            }
        });
    },
    
    deleteoffer : function(){
        var offer = $(this).attr('id');
        var offerId = offer.replace("offerdelete_","");
        var t = $(this);
        //        alert(admin.currentUrl);
        bootbox.confirm('Do you want to delete this offer',function(result){
             
            if(result){
               
                $.ajax({
                    url : admin.currentUrl,
                    Type : 'POST',
                    data :{
                        method : 'deleteoffer',
                        offerId : offerId
                    },
                    success : function(response){
                      
                        t.parent().parent().remove();
                    }
                })
            }
        })
    },
    
    ticketactive : function(){
        
        var tickets = $(this).attr('id');
        var ticketid= tickets.replace("ticket_","");
       
        $.ajax({
            url: admin.currentUrl,
            type: 'POST',
            datatype: 'HTML',
            data:{
                method : 'ticketactive',
                ticketid : ticketid
            },
            beforeSend : function() {},
            success : function(response) { 
               
                $('#'+"activeclass_"+response).removeClass('label label-block label-primary');
                $('#'+"activeclass_"+response).addClass('label label-block label-inverse');
                $('#'+"activeclass_"+response).html("Deactivate");
                $('#themes_'+response).removeClass('ticketactive');
                $('#themes_'+response).addClass('ticketdeactive');
                $('#'+"activemenu_"+response).html("Active");       
                top.location.href = 'ticket';
            }
        });
    },
    ticketdeactive : function(){
        
        var tickets = $(this).attr('id');
        var ticketid= tickets.replace("ticket_","");
      
        $.ajax({
            url: admin.currentUrl,
            type: 'POST',
            datatype: 'HTML',
            data:{
                method : 'ticketdeactive',
                ticketid : ticketid
            },
            beforeSend : function() {},
            success : function(response) { 
                $('#'+"activeclass_"+response).removeClass('label label-block label-inverse');
                $('#'+"activeclass_"+response).addClass('label label-block label-primary');
                $('#'+"activeclass_"+response).html("Activate");
                $('#themes_'+response).removeClass('ticketdeactive');
                $('#themes_'+response).addClass('ticketactive');
                $('#'+"activemenu_"+response).html("Suspended");       
                top.location.href = 'ticket';
            }
        });
    },
    deleteticket : function(){
        var tickets = $(this).attr('id');
        var ticketid= tickets.replace("ticketdelete_","");
        
        var t = $(this);
        //        alert(admin.currentUrl);
        bootbox.confirm('Do you want to delete this Ticket',function(result){
             
            if(result){
               
                $.ajax({
                    url : admin.currentUrl,
                    Type : 'POST',
                    data :{
                        method : 'deleteticket',
                        ticketid : ticketid
                    },
                    success : function(response){
                      
                        t.parent().parent().remove();
                    }
                })
            }
        })
    },
    
    productactive : function(){
        
        var product = $(this).attr('id');
        var productid= product.replace("product_","");
        $.ajax({
            url: admin.currentUrl,
            type: 'POST',
            datatype: 'HTML',
            data:{
                method : 'productactive',
                productid : productid
            },
            beforeSend : function() {},
            success : function(response) { 
               
                $('#'+"activeclass_"+response).removeClass('label label-block label-primary');
                $('#'+"activeclass_"+response).addClass('label label-block label-inverse');
                $('#'+"activeclass_"+response).html("Deactivate");
                $('#product_'+response).removeClass('productactive');
                $('#product_'+response).addClass('productdeactive');
                $('#'+"activemenu_"+response).html("Active");       
                top.location.href = 'store';
            }
        });
    },
    productdeactive : function(){
        
        var product = $(this).attr('id');
        var productid= product.replace("product_","");
        $.ajax({
            url: admin.currentUrl,
            type: 'POST',
            datatype: 'HTML',
            data:{
                method : 'productdeactive',
                productid : productid
            },
            beforeSend : function() {},
            success : function(response) { 
                $('#'+"activeclass_"+response).removeClass('label label-block label-inverse');
                $('#'+"activeclass_"+response).addClass('label label-block label-primary');
                $('#'+"activeclass_"+response).html("Activate");
                $('#product_'+response).removeClass('productdeactive');
                $('#product_'+response).addClass('productactive');
                $('#'+"activemenu_"+response).html("Suspended");       
                top.location.href = 'store';
            }
        });
    },
     
    deleteproduct : function(){
        var product = $(this).attr('id');
        var productid= product.replace("productdelete_","");
        
        var t = $(this);
        //        alert(admin.currentUrl);
        bootbox.confirm('Do you want to delete this Product',function(result){
             
            if(result){
               
                $.ajax({
                    url : admin.currentUrl,
                    Type : 'POST',
                    data :{
                        method : 'deleteproduct',
                        productid : productid
                    },
                    success : function(response){
                      
                        t.parent().parent().remove();
                    }
                })
            }
        })
    },
    promotionactive : function(){
        var promotion = $(this).attr('id');
        var promotion_id = promotion.replace("promotion_","");                
        var w = $(this);        
        $.ajax({
        
            url: admin.currentUrl,
            type: 'POST',
            datatype: 'json',
            data:{
                method : 'promotionactive',
                promote_id : promotion_id
            },
            beforeSend : function() {

            },
            success : function(response) {
                var x=JSON.parse(response);
                $('#'+"activeclass_"+x.resp).removeClass('label label-block label-primary');
                $('#'+"activeclass_"+x.resp).addClass('label label-block label-inverse');
                $('#'+"activeclass_"+x.resp).html("Deactivate");
                $('#promotion_'+x.resp).removeClass('promotionactive');
                $('#promotion_'+x.resp).addClass('promotiondeactive');
                $('#'+"activepromotion_"+x.resp).html("Active");
            }
            
        
        });
        
        
    },
    deletepromotion : function(){
        var promotions = $(this).attr('id');
        var promotion_id= promotions.replace("promotiondelete_","");
        
        var t = $(this);
        //        alert(admin.currentUrl);
        bootbox.confirm('Do you want to delete this Promotion?',function(result){
             
            if(result){
               
                $.ajax({
                    url : admin.currentUrl,
                    Type : 'POST',
                    data :{
                        method : 'deletepromotion',
                        promote_id : promotion_id
                    },
                    success : function(response){
                      
                        t.parent().parent().remove();
                    }
                })
            }
        })
    },
    promotiondeactive : function(){
        
        var promotions = $(this).attr('id');
        var promotionsid= promotions.replace("promotion_","");
      
        $.ajax({
            url: admin.currentUrl,
            type: 'POST',
            datatype: 'json',
            data:{
                method : 'promotionactive',
                promote_id : promotionsid
            },
            beforeSend : function() {},
            success : function(response) {
                var x=JSON.parse(response);
                $('#'+"activeclass_"+x.resp).removeClass('label label-block label-inverse');
                $('#'+"activeclass_"+x.resp).addClass('label label-block label-primary');
                $('#'+"activeclass_"+x.resp).html("Activate");
                $('#promotion_'+x.resp).removeClass('promotiondeactive');
                $('#promotion_'+x.resp).addClass('promotionactive');
                $('#'+"activepromotion_"+x.resp).html("Suspended");
            }
        });
    },
        
    deletefeatured : function(){        
        
        var contest = $(this).attr('id');
        var contestid = contest.replace("deteteFeatured_","");
        var w = $(this);
        bootbox.confirm("Do you want delete this Featured contest?", function(result)
        {
            if(result){
                $.ajax({
                  
                    url : '/admin/settings/jshandler',
                    type : 'POST',
                    datatype : 'HTML',
                    data :{
                        method : 'detetefeatured',
                        contestid : contestid
                    },
                    beforeSend : function(){
                      
                    },
                    success : function(response){
                        w.parent().parent().remove(); 
                    }  
                });
          
            }
              
        });
    },
userstatic: function(){        
     var url = $(this).val(); // get selected value
          if (url) { // require a URL
              window.location = url; // redirect
          }
          return false;
    },
profitstatic: function(){        
     var url = $('#pro_yr_select').val(); // get selected value
     var url = $('#pro_mo_select').val(); // get selected value
     var yr = $('#pro_yr_select').find(':selected').attr('data-id'); // get selected value
     var mo = $('#pro_mo_select').find(':selected').attr('data-month'); // get selected value
     url = url+yr+'&mo='+mo;     
          if (url) { // require a URL
              window.location = url; // redirect
          }
          return false;
    }
 
}


 
$(document).ready(function(){
    $('#match_id').on('change',function(e){
        var str = $('#match_id').val();      
        var time = str.split("@");      
        $('#start_time').val(time[1]);            
    }) ;
  
    $('#sports_id_contest').on('change',function(e){
        var sports_id = $('#sports_id_contest').val();            
  
        $.ajax({

            url      : './get-contest',
            type     : 'POST',
            dataType : 'json',
            data : {                
                sports_id : sports_id
            },
            beforeSend : function() {

            },
            success : function(response) {  
                
                $('.new_contest').html('');
                $("#match_id").html('');
                    
                if(response.code != '198'){ 
                    
                    $("#errmgs").css('display', 'none') ;  
                    $("#show_data").css('display', '') ;                   
                    $("#match_id").append('<option value="">Select</option>');
                    $.each(response,function( index, value ) {
                        $(".new_contest").append('<tr><td>'+value.id+'</td><td>'+value.match_date+'</td><td>'+value.match_time+'</td><td>'+value.hometeam+'</td><td>'+value.awayteam+'</td><td>'+value.status+'</td></tr>');
                        $("#match_id").append('<option value="'+value.id+'@'+value.match_time+'@'+value.match_date+'">'+value.id+'</option>');
                    });
                     $('#new_contest_table').dataTable({
                        paging: true
                    });	
                }else{
                    $("#errmgs").css('display', 'block') ;
                    $("#show_data").css('display', 'none') ;    
                }
                  
            }

        });   
  
    }) ;
  
});
/**
  * Developer   : Vivek Chaudhari
  * Date        : 23/08/2014 
  * Description :contest crate form validation on ranks,player limits and new rows
  */
//-------------------------------------------------------------------------------------
$(document).ready(function(){
    $(document.body).on('keyup','#entry_limit',function(){
//        $('#selpri').prop('selectedIndex',0);
        $('#addnewrank').html('');
        $('#rankamt').css("display","none");
    });
    $(document.body).on('change','#selpri',function(){
        var prize = $(this).val();
        if(prize == 6){
            var elimit = $('#entry_limit').val();
            if((elimit == undefined)||(elimit <= 1)){
                alert('Player entry limit should atleast more than one');
            }else if(elimit > 1){
                $('#rankamt').css("display","block"); 
                $('#rank_frm1').html('');
                $('#rank_frm1').append('<option value="">Select</option>');
                for(var i=1;i<=elimit;i++){
                    $('#rank_frm1').append('<option value="'+i+'">'+i+'</option>');
                }
            }
        }else{
            $('#rankamt').css("display","none");
            $('#addnewrank').html('');
        }
    });
     
    $(document.body).on('change','.rankfrom',function(){
        $(this).parent().parent().parent().parent().find('.rankto').html(' ');
        var elimit = parseInt($('#entry_limit').val());
        var from = parseInt($(this).val());
        $(this).parent().parent().parent().parent().find('.rankto').append('<option value="">Select</option>');
        $(this).parent().parent().parent().parent().find('.rankto').append('<option value="0">0</option>');
        for(var j= from+1; j<=elimit; j++){
            $(this).parent().parent().parent().parent().find('.rankto').append('<option value="'+j+'">'+j+'</option>');
        }
    });
     
    $(document.body).on('click','#selectnewrow',function(){
        var rankto = parseInt($('.rankto:last').val());
        if(rankto == 0){
            rankto = parseInt($('.rankfrom:last').val());
        }
        var elimit = parseInt($('#entry_limit').val()); 
        if(rankto < elimit){
               
            $('.addrow').find('.rankfrom').html('');
            $('.addrow').find('.rankfrom').append('<option value="">Select</option>');
            for(var j = rankto+1; j<= elimit; j++){
                $('.addrow').find('.rankfrom').append('<option value="'+j+'">'+j+'</option>');
            }
            var addrank = $('.addrow').html(); 
            $('#addnewrank').append(addrank); 
        }else{
            alert('player limit reached to maximum');
        }
    }) ;  
    $(document.body).on('change','.payout_type',function(){
        var type = $(this).val();
        $(this).parent().parent().parent().parent().find('.prize_type').html('');
        var amountbox = $('#inputamount').html();
        var ticketselect = $('#selectticket').html();
        if(type == 0){
            $(this).parent().parent().parent().parent().find('.prize_type').append(amountbox); 
            $(this).parent().parent().parent().parent().find('.rankamount').css("display","block");
        }else if(type == 1){
            $(this).parent().parent().parent().parent().find('.prize_type').append(ticketselect); 
            $(this).parent().parent().parent().parent().find('.tickets').css("display","block");
        }
    });
    
    $(document.body).on('click','.removerow',function(){
        $(this).parent().parent().html(''); 
    });
        
    $(document.body).on('keyup','#prize_pool',function(){ 
        var pentry = parseInt($('#entry_limit').val());
        var fee = parseInt($('#fee').val());
        if(($.isNumeric(fee))&&($.isNumeric(pentry))){
            var total = fee*pentry;
            var tpool = total - (total*0.1); // 10% prize pool rake for admin
            var pool = $(this).val();
            if(pool > tpool){
                $(this).val('');
                alert('prize pool limit reached to maximum, It should be less than or equal to $'+tpool);
            }
        }else{
            $(this).val('');
            alert('player entry and entry fee should not be empty');
        }
    });   
   
    $(document.body).on('keyup','.rankamount',function(){ 
        var pool = parseInt($('#prize_pool').val());
        var from = parseInt($(this).parent().parent().parent().find('.rankfrom').val());
        var to =  parseInt($(this).parent().parent().parent().find('.rankto').val());
        var rank_limit = (to-from)+1;
        if(to == 0){
            rank_limit = 1;
        }
        var input = parseInt($(this).val());
        if(pool != ""){
            var rank_amount = (rank_limit*input);
            $(this).attr('data-pamt',rank_amount);
            //console.log(rank_amount);
            var totalPoolAmount = 0;
            $(document.body).find('.prize_type').find('.rankamount').each(function(){
                totalPoolAmount = parseFloat(totalPoolAmount) + parseFloat($(this).attr('data-pamt'));
            }); //console.log(totalPoolAmount);
            if(totalPoolAmount > pool){
                $(this).val('');
                $(this).attr('data-pamt',0);
                alert('amount prize reached to maximum');
            }
        }else{
            alert('Prize pool should not be empty');
        }
       
    });
    $(document.body).on('keyup','#fee',function(){
   
        var fee = parseInt($(this).val()); // console.log(fee);
        if(($.isNumeric(fee))&&(fee < 100)){
            var fpp = fee*4;
            fpp = fpp.toFixed();
            $('#fpp_reword').val(fpp);
        }else if(($.isNumeric(fee))&&(fee >= 100 && fee < 500)){
            var fpp = fee*3.3;
            fpp = fpp.toFixed();
            $('#fpp_reword').val(fpp);
        }else if(($.isNumeric(fee))&&(fee >= 500)){
            var fpp = fee*2.26;
            fpp = fpp.toFixed(); 
            $('#fpp_reword').val(fpp);
        }
    }); 
    
    $(document.body).on('change','#contest_type',function(){
        var type = parseInt($(this).val()); 
        $("#selpri").html('');
        $('#selpri').attr('disabled',false);
        $('#entry_limit').attr('readonly',false);
        $('#challenge_limit').attr('readonly',false);
        $('#selpri').val('');
        $('#entry_limit').val('');
        $('#challenge_limit').val('');
        $('#selpri option[value="5"]').remove();
        $('#selpri option[value="1"]').remove();
        
        $("#selpri").append('<option value="">Select</option>');
        $("#selpri").append('<option value="0">No Prize</option>');
        $("#selpri").append('<option value="1">winner takes all</option>');
        $("#selpri").append('<option value="2">Top 2 Win</option>');
        $("#selpri").append('<option  value="6">Custom Prizes</option>');
        if(type === 3){
            $('#entry_limit').val(2);
            $('#entry_limit').attr('readonly',true);
            $('#challenge_limit').val(0);
            $('#challenge_limit').attr('readonly',true);
            $("#selpri").html('');
            $("#selpri").append('<option value="1">winner takes all</option>');
        }else if (type === 4){
            $("#selpri").html('');
            $("#selpri").append('<option selected="selected" value="5">50/50</option>');
        }
    });
//   =======================================================================================
});

 

//$(document).ready(function(){
//
//$(".signupform").validate({
//        rules: {
//            username: {
//                required: true,
//                regex: /^[a-zA-Z0-9_\.]+$/
//                
//            },
//            email: {
//                required: function(element) {
//                    if(getRole() == 'signup'){
//                        return true;
//                    }
//                },
//                email: true  
//            },
//            password: {
//                required: true,
//                minlength: 5,
//                maxlength:10
//            },
//            confirmPassword: {
//                required: function(element) {
//                    if(getRole() == 'signup'){
//                        return true;
//                    }
//                },
//                minlength: 5,
//                maxlength:10,
//                equalTo: "#passwordinp"
//            },
//            countryoption: {
//                required: function(element) {
//                    if(getRole() == 'signup'){
//                        return true;
//                    }
//                }
//            },
//            cityoption: {
//                required: function(element) {
//                    if(getRole() == 'signup'){
//                        return true;
//                    }
//                }
//            },
//            agreeterms: {
//                required: function(element) {
//                    if(getRole() == 'signup'){
//                        return true;
//                    }
//                }
//            },
//            ageconfirm: {
//                required: function(element) {
//                    if(getRole() == 'signup'){
//                        return true;
//                    }
//                }
//            }            
//            
//        },
//        messages: {
//            username: {
//                required: "Username is required Field",
//                regex: "Invalid Format"
//            },
//            email: {
//                required: "Email is required Field",
//                email: "Invalid Email Format"
//            },
//            password: {
//                required: "Password is required Field",
//                minlength: "Minimum Length of password is 3",
//                maxlength: "MaxLength of Password is 10"
//            },
//            confirmPassword: {
//                required: "This is required Field",
//                minlength: "Minimum Length of password is 3",
//                maxlength: "MaxLength of Password is 10",
//                equalTo: "Password Doesn't Match"
//            },
//            countryoption: {
//                required: "Country is required Field"
//            },
//            cityoption: {
//                required: "City is required Field"
//            },
//            agreeterms: {
//                required: "You Must Agree to term and condition"
//            },
//            ageconfirm: {
//                required: "Confirm Age Verification"
//            }
//            
//        }
//
//});
//
//});


function limitText(limitField, limitCount, limitNum) {
    if (limitField.value.length > limitNum) {
        limitField.value = limitField.value.substring(0, limitNum);
    } else {
        limitCount.value = limitNum - limitField.value.length;
    }
}


/*
 *Name: Abhinish Kuamr Singh
 *Date: 11/07/2014
 *Description: This code is used for many form validations as well as form submission.
 */

$(document).ready(function(){
    var editprofilesubmit = { 
        url:  '/', 
        type: 'POST',
        dataType : 'HTML',
        data : {},
        beforeSend: function(){
        },
        success:    function(response) {} 
    };


    $(".usereditform").validate({
        rules: {
            email: {
                required: true,
                email: true,
                maxlength: 300  
            },
            country_name: {
                required: true
            },
            state_code: {
                required: true
            },
            new_password: {
                minlength: 5,
                maxlength:30,
                regex: /^[a-zA-Z0-9_\.]+$/
                
            }            
            
        },
        messages: {
            email: {
                required: "Email is required Field",
                email: "Invalid Email Forma",
                maxlength: "Maximum length of Email is 300"
            },
            new_password: {
                minlength: "Minimum length of password is 5",
                maxlength: "Maximum length of Password is 30",
                regex: "Invalid Format"
            },
            country_name: {
                required: "Country is required Field"
            },
            state_code: {
                required: "State Code is required Field"
            }
            
        },
        submitHandler: function(form) {
            $(form).ajaxSubmit(editprofilesubmit);
            return false;
        }

    }); 

    $(".contesteditform").validate({
        rules: {
            contest_name: {
                required: true,
                maxlength: 650
            },
            sports_id: {
                required: true,
                maxlength: 11,
                regex: /^\d+$/
            },
            entry_limit: {
                required: true,
                maxlength: 5,
                regex: /^\d+$/
            },
            challenge_limit: {
                required: true,
                maxlength: 3,
                regex: /^\d+$/
            },
            fee: {
                required: true,
                regex: /^(?:\d*\.\d{1,2}|\d+)$/
            },
            match_id: {
                required: true,
                maxlength: 10,
                regex: /^\d+$/
            },
            prize_pool: {
                required: true,
                regex: /^(?:\d*\.\d{1,2}|\d+)$/
            },
            fpp_reword: {
                required: true,
                maxlength: 8,
                regex: /^\d+$/
            },
            start_time: {
                required: true,
                minlength: 19,
                maxlength: 19,
                regex: /^(\d{4})-(\d{2})-(\d{2}) (\d{2}):(\d{2}):(\d{2})$/
            },
            contest_type: {
                required: true
            },
            play_type: {
                required: true
            },
            prize_type: {
                required: true
            },
            desctext: {
                required: true,
                maxlength: 650
            }            
            
        },
        messages: {
            contest_name: {
                required: "Contest name is required",
                maxlength: "Maximum number of characters allowed is 650"
            },
            sports_id: {
                required: "Sports ID is Required",
                maxlength: "Maximum 11 digits are allowed",
                regex: "Please enter only digits"
            },
            entry_limit: {
                required: "Entry limit is required",
                maxlength: "Maximum 5 digits are allowed",
                regex: "Please enter only digits"
            },
            challenge_limit: {
                required: "Challenge limit is required",
                maxlength: "Maximum 3 digits are allowed",
                regex: "Please enter only digits"
            },
            fee: {
                required: "Entry fee is required",
                regex: "Please enter numbers only(decimals also allowed)"
            },
            prize_pool: {
                required: "Prize pool is required",
                regex: "Please enter numbers only(decimals also allowed)"
            },
            fpp_reword: {
                required: "FPP Reward is required",
                maxlength: "Maximum 8 digits are allowed",
                regex: "Please enter digits only"
            },
            contest_type: {
                required: "Contest Type is required"
            },
            play_type: {
                required: "Play Type is required"
            },
            prize_type: {
                required: "Prize is required"
            },
            desctext: {
                required: "Description is required",
                maxlength: "Maximum number of characters allowed is 650"
            }
            
        },
        submitHandler: function(form) {
            $(form).ajaxSubmit(editprofilesubmit);
            return false;
        }

    });

    $(".editcontesttypeform").validate({
        rules: {
            contest_name: {
                required: true,
                maxlength: 55  
            },
            status: {
                required: true
            }            
            
        },
        messages: {
            contest_name: {
                required: "Contest Name is required Field",
                maxlength: "Maximum length of Contest Name is 55"
            },
            status: {
                required: "Status is required Field"
            }
            
        },
        submitHandler: function(form) {
            $(form).ajaxSubmit(editprofilesubmit);
            return false;
        }

    });

    $(".newcontesttypeform").validate({
        rules: {
            contest_name: {
                required: true,
                maxlength: 55  
            },
            status: {
                required: true
            }            
            
        },
        messages: {
            contest_name: {
                required: "Contest Name is required Field",
                maxlength: "Maximum length of Contest Name is 55"
            },
            status: {
                required: "Status is required Field"
            }
            
        },
        submitHandler: function(form) {
            $(form).ajaxSubmit(editprofilesubmit);
            return false;
        }

    });

    $(".editsportdetailsform").validate({
        rules: {
            sports_name: {
                required: true,
                maxlength: 25  
            },
            status: {
                required: true
            }            
            
        },
        messages: {
            sports_name: {
                required: "Sport Name is required Field",
                maxlength: "Maximum length of Sport Name is 25"
            },
            status: {
                required: "Status is required Field"
            }
            
        },
        submitHandler: function(form) {
            $(form).ajaxSubmit(editprofilesubmit);
            return false;
        }

    });

    $(".newsportsform").validate({
        rules: {
            sports_name: {
                required: true,
                maxlength: 25  
            },
            status: {
                required: true
            }            
            
        },
        messages: {
            sports_name: {
                required: "Sport Name is required Field",
                maxlength: "Maximum length of Sport Name is 25"
            },
            status: {
                required: "Status is required Field"
            }
            
        },
        submitHandler: function(form) {
            $(form).ajaxSubmit(editprofilesubmit);
            return false;
        }

    });

    $(".editcountryform").validate({
        rules: {
            country_code: {
                required: true,
                maxlength: 5,
                regex: /^[A-Z]+$/
            },
            country_name: {
                required: true,
                maxlength: 85  
            },
            status: {
                required: true
            }            
            
        },
        messages: {
            country_code: {
                required: "Country Code is required Field",
                maxlength: "Maximum length of Country Code is 5",
                regex: "Enter only capital letters"
            },
            country_name: {
                required: "Country Name is required Field",
                maxlength: "Maximum length of Country Name is 85"
            },
            status: {
                required: "Status is required Field"
            }
            
        },
        submitHandler: function(form) {
            $(form).ajaxSubmit(editprofilesubmit);
            return false;
        }

    });

    $(".editofferform").validate({
        rules: {
            offer_name: {
                required: true,
                maxlength: 155  
            },
            description: {
                required: true
            },
            offer_type: {
                required: true
            }
        //            imagefile: {
        //                required: true
        //            } 

            
        },
        messages: {
            offer_name: {
                required: "Offer Name is required Field",
                maxlength: "Maximum length of Offer Name is 155"
            },
            description: {
                required: "Offer Description is required Field"
            },
            offer_error: {
                required: "Offer Type is required"
            }
        }

    });
    
    
    $(".addcontestpromotion").validate({
        rules: {
            promotion_display_name: {
                required: true,
                regex:/^([a-zA-Z0-9]+\s)*[a-zA-Z0-9]+$/,
                maxlength: 55  
            },
            status: {
                required: true
            } 

            
        },
        messages: {
            promotion_display_name: {
                required: "Promotion Display Name is required field",
                regex: "Only one space is allowed between words",
                maxlength: "Maximum length of Promotion Display Name is 55"
            },
            status: {
                required: "Status is required"
            }
            
        },
        submitHandler: function(form) {
            $('.adddiserr').html("");
            var set=0;
            var dispname = document.getElementById('promotion_display_name').value;
            
            $.ajax({
        
                url: admin.currentUrl,
                type: 'POST',
                async: false,
                datatype: 'json',
                data:{
                    method : 'checkdispname',
                    promote_name : dispname
                },
                beforeSend : function() {

                },
                success : function(response) {  
                
                
                    var x=JSON.parse(response);
                    set=x.resp;
                    return;
                }
            
        
            });
            if(set){
                $(form).ajaxSubmit(editprofilesubmit);
            }else{
                $('.adddiserr').html("Display name already exists.");
            }
            return false;
        }

    });

    $(".editcontestpromotion").validate({
        rules: {
            promotion_display_name: {
                required: true,
                regex:/^([a-zA-Z0-9]+\s)*[a-zA-Z0-9]+$/,
                maxlength: 55  
            },
            status: {
                required: true
            } 

            
        },
        messages: {
            promotion_display_name: {
                required: "Promotion Display Name is required field",
                regex: "Only one space is allowed between words",
                maxlength: "Maximum length of Promotion Display Name is 55"
            },
            status: {
                required: "Status is required"
            }
            
        },
        submitHandler: function(form) {
            $(form).ajaxSubmit(editprofilesubmit);
            return false;
        }

    });
});


 
 
/*
 * Name: Abhinish Kumar Singh
 * Date: 14/07/2014
 * Description: This function integrates a html editor in text area of add contest promotions
 */
$(document).ready(function(){
    
    tinymce.init({
        selector: "#promotion_content",
        plugins: [
        "advlist autolink lists link image charmap print preview anchor",
        "searchreplace visualblocks code fullscreen",
        "insertdatetime media table contextmenu paste"
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
    });

    
    
});

/**
        * Developer     : Vivek Chaudhari   
        * Date          : 18/07/2014
        * Description   : player details section with disability list 
        */
//-------------------------------------------------start-----------------------------------------------------------------//       
$(document).ready(function(){
    var playertable;
    $('body').on('click','.team',function(){
        var team = $(this).attr('data-tcode');
        var sport = $('#sportId').attr('value');
        $.ajax({
            type    : "POST",
            url     : '/admin/player-details',
            dataType: 'json',
            data    : {
                method : "getPlayers",
                team : team,
                sport : sport
            },
            beforeSend : function() {},
            success : function(response){
                $('#plydetails').css('display','block');
                
                $('table#plr_table tbody').html('');
                var srNo = 1;
                var plrdatatable = document.getElementById('plr_table');
                if ($.fn.DataTable.fnIsDataTable( plrdatatable ) ) {
                   playertable.fnClearTable();
                    playertable.fnDestroy(); 
                    plrdatatable = document.getElementById('plr_table');
                }
                $.each(response, function(key,value){                    
                    var data = $.parseJSON(value.plr_details);  
                    if(data.position_name == "Disabled List"){
         
                        $('table#plr_table tbody').append('<tr><td class="center disable">'+srNo
                            +'</td><td class="center">'+data.name
                            +'<span  style="color:red; margin : 5px;">In</span></td><td class="center">'+data.position
                            +'</td><td class="center">'+value.fppg
                            +'</td><td class="center">'+'$'+value.plr_value
                            +'</td><td class="center">'+data.team_name
                            +'</td>'
                            +'<td class="center"> <a id="'+value.plr_id+'" href="edit-disability/'+value.plr_id+'@'+value.gmp_id+'" class="btn-action glyphicons pencil btn-danger"><i></i></a> </td></tr>');
                    }else if(value.injury_status == "1"){
                    $('table#plr_table tbody').append('<tr><td class="center disable">'+srNo
                            +'</td><td class="center">'+data.name
                            +'<span  style="color:red; margin : 5px;">In</span></td><td class="center">'+data.position
                            +'</td><td class="center">'+value.fppg
                            +'</td><td class="center">'+'$'+value.plr_value
                            +'</td><td class="center">'+data.team_name
                            +'</td>'
                            +'<td class="center"> <a id="'+value.plr_id+'" href="edit-disability/'+value.plr_id+'@'+value.gmp_id+'" class="btn-action glyphicons pencil btn-danger"><i></i></a> </td></tr>');
                    
                    }else {
                        $('table#plr_table tbody').append('<tr><td class="center ">'+srNo
                            +'</td><td class="center">'+data.name
                            +'</td><td class="center">'+data.position
                            +'</td><td class="center">'+value.fppg
                            +'</td><td class="center">'+'$'+value.plr_value
                            +'</td><td class="center">'+data.team_name
                            +'</td>'
                            +'<td class="center"> <a target= "_blank"  id="'+value.plr_id+'" href="edit-disability/'+value.plr_id+'@'+value.gmp_id+'" class="btn-action glyphicons pencil btn-success"><i></i></a> </td></tr>');
                    }
                    
                    srNo++;    
                });
                
            if ( ! $.fn.DataTable.fnIsDataTable( plrdatatable ) ) {
               playertable  = $(plrdatatable).dataTable();
            }
            }
        });
    });
    
    $(document.body).on('click','#disable_check',function(){
        if($(this).prop('checked')){
            $('table#plr_table tbody tr').each(function(){
                if(!$(this).children().hasClass('center disable')){
                    $(this).hide();
                }
            });
           
        }else{
            $('table#plr_table tbody tr').each(function(){
                $(this).show();
            });
        } 
    });
});    

$(document).ready(function(){
    $('body').on('click','.sport',function(){
        var sport = $(this).val();
        $('#sportId').attr('value',sport);
        $.ajax({
            type        : 'POST',
            url         : '/admin/player-details',
            data        : {
                method : "getTeams",
                sport : sport
            },
            dataType    : 'json',
            success     : function(response){
                $('table#plr_table tbody tr').remove();
                $('#remove_menu').remove();
                if(response!=0){
                    $('#team_menu').append('<div id="remove_menu"><label class="control-label span1">Teams :-</label>'+
                        '<div class="controls">'+
                        '<select id="team_id" class="span4" name="team_id" ><option class="team">Select Team</option>'+
                        '</select>'+
                        '</div></div>');

                    $.each(response, function(key,value){
                        $('#team_id').append('<option class="team" data-tcode='+key+'>'+value+'</option>');
                    }); 
                }else{
                    $('#team_menu').append('<div id="remove_menu"><h5>No Teams Available for This Sport</h5></div>')
                }
            }
        });
    });
    
          
      $(document.body).on('click','#sendsuccess',function(){
            var email = $('#sendto').val();
            var subject = $('#subject').val();
            var message = $('#message').val();
            var username = $('#username').html();
            if(subject == ""){
                alert('please provide a subject')
            }else if(message == ""){
                alert('please provide a message')
            }else if( message != "" ,  subject != ""){
                $.ajax({
                        url      : 'https://draftdaily.com/admin/mailer', 
                        type     : 'POST',
                        dataType : 'json',
                        data : {
                            method : 'sendmail',
                            email : email,
                            subject : subject, 
                            message : message,
                            username : username
                        },
                        beforeSend : function() {
                                
                        },
                        success : function(response) {
                            if(response.code==200){
                                $('#ret-msg').show();
                                $('#ret-msg').css('color','green');
                                $('#ret-msg').html(response.message);
                                $('#subject').val('');
                                $('#message').val('');
                            }else if(response.code == 198){
                                $('#ret-msg').show();
                                $('#ret-msg').css('color','red');
                                $('#ret-msg').html(response.message);
                            }
                            setTimeout("$('#ret-msg').hide();",5000);
                        }
                });
            }
        });
});
//========================================================end=============================================================//

/**
        * Developer     : Vivek Chaudhari   
        * Date          : 28/07/2014
        * Description   : image file extension validation
        */
//---------------------------------------------------start--------------------------------------------------------------------//
$(document).ready(function () {
    $('body').on('change','#imagefile',function(){
        
        var value = $(this).val(),
        file = value.toLowerCase(),
        extension = file.substring(file.lastIndexOf('.') + 1);
        if((extension==='jpg')||(extension==='png')||(extension==='jpeg')){
            $('#errormsg').html('');
        }else{
            $('#errormsg').html('Please select valid file extension *.jpg or *.png or *.jpeg only');
        }
                    
    }); 
});

//====================================================end==============================================================//
$(document).ready(function(){
    
   
    $(".newcontestform").validate({
        rules: {
            contest_name: {
                required: true,
                maxlength: 650
            },
            entry_limit: {
                required: true,
                maxlength: 5,
                regex: /^\d+$/
            },
            challenge_limit: {
                required: true,
                maxlength: 3,
                regex: /^\d+$/
            },
            fee: {
                required: true,
                regex: /^(?:\d*\.\d{1,2}|\d+)$/
            },
            match_id: {
                required: true
            },
            prize_pool: {
                required: true,
                regex: /^(?:\d*\.\d{1,2}|\d+)$/
            },
            fpp_reword: {
                required: true,
                maxlength: 8,
                regex: /^\d+$/
            },
            contest_type: {
                required: true
            },
            play_type: {
                required: true
            },
            prize_type: {
                required: true
            },
            desctext: {
                required: true,
                maxlength: 650
            }            
            
        },
        messages: {
            contest_name: {
                required: "Contest name is required",
                maxlength: "Maximum number of characters allowed is 650"
            },
            entry_limit: {
                required: "Entry limit is required",
                maxlength: "Maximum 5 digits are allowed",
                regex: "Please enter only digits"
            },
            challenge_limit: {
                required: "Challenge limit is required",
                maxlength: "Maximum 3 digits are allowed",
                regex: "Please enter only digits"
            },
            fee: {
                required: "Entry fee is required",
                regex: "Please enter numbers only(decimals also allowed)"
            },
            prize_pool: {
                required: "Prize pool is required",
                regex: "Please enter numbers only(decimals also allowed)"
            },
            fpp_reword: {
                required: "FPP Reward is required",
                maxlength: "Maximum 8 digits are allowed",
                regex: "Please enter digits only"
            },
            contest_type: {
                required: "Contest Type is required"
            },
            match_id: {
                required: "Match ID is required"
            },
            play_type: {
                required: "Play Type is required"
            },
            prize_type: {
                required: "Prize is required"
            },
            desctext: {
                required: "Description is required",
                maxlength: "Maximum number of characters allowed is 650"
            }
            
        }

    });
    
    
    
    /*
    * Name: Abhinish Kumar Singh
    * Date: 29/07/2014
    * Description: This contains validation rules and messages for offers upload
    *              section.
    */ 
    $(".offersfileform").validate({
        rules: {
            imagefile: {
                required: true
            },
            offer_name: {
                required: true,
                maxlength: 155
            },
            end_date: {
                required: true
            },
            description: {
                required: true
            },
            contest: {
                required: true
            }            
            
        },
        messages: {
            imagefile: {
                required: "Please select an Image"
            },
            offer_name: {
                required: "Please enter Offer Name",
                maxlength: "Maximum length of Offer Name is 155 characters"
            },
            end_date: {
                required: "Please enter End Date"
            },
            description: {
                required: "Please enter Description"
            },
            contest: {
                required: "Please select a Contest"
            } 
            
        }

    });
    
    
    
    /**
  * Developer : Abhinish Kumar Singh
  * Date : 29/07/2014 
  * Description :This function is used to validate the valid-tickets form  
  */       
        
    $(".ticketdetails").validate({
        rules: {
            code: {
                regex: /^[a-z0-9]+$/i,
                required: true
            },
            bunus_amt: {
                regex: /^\d+$/,
                required: true
            },
            status: {
                required: true
            },
            limitation: {
                required: true
            },
            valid_from: {
                required: true
            },
            valid_upto: {
                required: true
            }            
            
        },
        messages: {
            code: {
                regex: "Please enter only alphabets and numbers",
                required: "Please enter the ticket code"
            },
            bunus_amt: {
                regex: "Please enter only numbers",
                required: "Please enter balance ammount"
            },
            status: {
                required: "Status is required"
            },
            limitation: {
                required: "Please enter limitation"
            },
            valid_from: {
                required: "Please enter valid from date"
            },
            valid_upto: {
                required: "Please enter valid upto date"
            } 
            
        }
    });
        
    /*
  * Developer : Abhinish Kumar Singh
  * Date : 29/07/2014 
  * Description :This function is used to validate the edit-ticket form  
  */       
        
    $(".editticketform").validate({
        rules: {            
            bonus_amt: {
                regex: /^\d+$/,
                required: true
            },
            status: {
                required: true
            },
            limitation: {
                required: true
            },
            valid_from: {
                required: true
            },
            valid_upto: {
                required: true
            }            
            
        },
        messages: {
            code: {
                regex: "Please enter only alphabets and numbers",
                required: "Please enter the ticket code"
            },
            bonus_amt: {
                regex: "Please enter only numbers",
                required: "Please enter balance ammount"
            },
            status: {
                required: "Status is required"
            },
            limitation: {
                required: "Please enter limitation"
            },
            valid_from: {
                required: "Please enter valid from data"
            },
            valid_upto: {
                required: "Please enter valid upto data"
            } 
            
        }
    });
        
        
    /**
  * Developer : Abhinish Kumar Singh
  * Date : 29/07/2014 
  * Description :function validates store form    
  */
    $(".storedetailsform").validate({
        rules: {
            product_name: {
                regex: /^([a-zA-Z0-9]+\s)*[a-zA-Z0-9]+$/,
                required: true
            },
            url: {
                regex: /(http|https):\/\/[\w-]+(\.[\w-]+)+([\w.,@?^=%&amp;:\/~+#-]*[\w@?^=%&amp;\/~+#-])?/,
                required: true
            },
            fpp_point: {
                regex: /^\d+$/,
                required: true
            },
            real_cash: {
                regex: /^(?:\d*\.\d{1,2}|\d+)$/,
                required: true
            },
            qty: {
                regex: /^\d+$/,
                required: true
            }            
            
        },
        messages: {
            product_name: {
                regex: "Please enter only alphabets and numbers",
                required: "Please enter Product Name"
            },
            url: {
                regex: "Please enter a valid URL",
                required: "Please enter URL"
            },
            fpp_point: {
                regex: "Please enter only digits",
                required: "Please enter FPP Point"
            },
            real_cash: {
                regex: "Please enter number only with decimals upto double precision",
                required: "Please enter real cash"
            },
            qty: {
                regex: "Please enter only numbers",
                required: "Please enter quantity"
            } 
            
        }
    });
        
        
    /**
  * Developer : Abhinish Kumar Singh
  * Date : 29/07/2014 
  * Description :This function validates store form(edit product)    
  */
    $(".editproductform").validate({
        rules: {
            product_name: {
                regex: /^([a-zA-Z0-9]+\s)*[a-zA-Z0-9]+$/,
                required: true
            },
            url: {
                regex: /(http|https):\/\/[\w-]+(\.[\w-]+)+([\w.,@?^=%&amp;:\/~+#-]*[\w@?^=%&amp;\/~+#-])?/,
                required: true
            },
            fpp_point: {
                regex: /^\d+$/,
                required: true
            },
            real_cash: {
                regex: /^(?:\d*\.\d{1,2}|\d+)$/,
                required: true
            },
            qty: {
                regex: /^\d+$/,
                required: true
            }            
            
        },
        messages: {
            product_name: {
                regex: "Please enter only alphabets and numbers",
                required: "Please enter Product Name"
            },
            url: {
                regex: "Please enter a valid URL",
                required: "Please enter URL"
            },
            fpp_point: {
                regex: "Please enter only digits",
                required: "Please enter FPP Point"
            },
            real_cash: {
                regex: "Please enter number only with decimals upto double precision",
                required: "Please enter real cash"
            },
            qty: {
                regex: "Please enter only numbers",
                required: "Please enter quantity"
            } 
            
        }
    });       
        
        
    /**
  * Developer : Ramanjineyulu G
  * Date : 16/07/2014 
  * Description :function describes validation for respective fields.   
  */         
    $(".themedetails").validate({
        rules: {
            themezipped: {                
                required: true
            }
        },
        messages: {
            themezipped: {                              
                required: "Please select a File"
            }
             
        }
    });
    

    /*
 * Developer: Abhinish Kumar Singh
 * Date: 30/07/2014
 * Description: This function is used to validate new-contests form which contains
 *              dynamic fields.
 */
    //$(document.body).on('click','#submitnewcontest',function(e){
    //    e.preventDefault();
    //    $('.help-block').html("");
    //    var valid = 0;
    //    var contestname = $.trim($('input[name=contest_name]').val());
    //    var entrylimit = $.trim($('input[name=entry_limit]').val());
    //    var challengelimit = $.trim($('input[name=challenge_limit]').val());
    //    var fee = $.trim($('input[name=fee]').val());
    //    var matchid = $.trim($('select[name=match_id]').val());
    //    var prizepool = $.trim($('input[name=prize_pool]').val());
    //    var fppreword = $.trim($('input[name=fpp_reword]').val());
    ////    var starttime = $.trim($('input[name=start_time]').val());
    //    var contesttype = $.trim($('input[name=contest_type]').val());
    //    var playtype = $.trim($('input[name=play_type]').val());
    //    var prizetype = $.trim($('input[name=prize_type]').val());
    //    var desctext = $.trim($('input[name=desctext]').val());
    //    
    //    
    //    var number = /^\d+$/;
    //    var currency = /^(?:\d*\.\d{1,2}|\d+)$/;
    //    
    //    
    //    
    //    
    //    
    //    if(contestname != ""){
    //        
    //        
    //    }else{
    //        valid = 1;
    //        $('#contestname').html("Please enter Contest Name");
    //    }
    //    if(entrylimit != ""){
    //        if(number.test(entrylimit)){
    //            if(entrylimit.toString().length > 3){
    //               valid = 1;
    //            $('#entrylimit').html("Maximum three digits allowed"); 
    //            }
    //        }else{
    //            valid = 1;
    //            $('#entrylimit').html("Please enter only Numbers");
    //        }
    //    }else{
    //        valid = 1;
    //        $('#entrylimit').html("Please enter Entry Limit");
    //    }
    //    if(challengelimit != ""){
    //        if(number.test(challengelimit)){
    //           if(challengelimit.toString().length > 3){
    //               valid = 1;
    //            $('#challengelimit').html("Maximum three digits allowed"); 
    //            } 
    //        }else{
    //           valid = 1;
    //           $('#challengelimit').html("Please enter only Numbers");
    //        }
    //    }else{
    //        valid = 1;
    //        $('#challengelimit').html("Please enter Challenge Limit");
    //    }
    //    if(fee != ""){
    //        if(currency.test(fee)){
    //            
    //        }else{
    //            $('#feeee').html("Please enter only Digits or Decimal Numbers");
    //            valid = 1;
    //        }
    //    }else{
    //        valid = 1;
    //        $('#feeee').html("Please enter Entry Fee");
    //    }
    //    if(matchid != ""){
    //        
    //    }else{
    //        valid = 1;
    //        $('#matchid').html("Please Select Match ID");
    //    }
    //    if(prizepool != ""){
    //        if(currency.test(prizepool)){
    //            
    //        }else{
    //            $('#prizepool').html("Please enter only Digits or Decimal Numbers");
    //            valid = 1;
    //        }
    //    }else{
    //        valid = 1;
    //        $('#prizepool').html("Please enter prize pool");
    //    }
    //    if(fppreword != ""){
    //        if(number.test(fppreword)){
    //            if(fppreword.toString().length > 8){
    //               valid = 1;
    //            $('#fppreword').html("Maximum eight digits allowed"); 
    //            }
    //        }else{
    //            $('#fppreword').html("Please enter only Numbers");
    //            valid = 1;
    //        }
    //    }else{
    //        valid = 1;
    //        $('#fppreword').html("Please enter FPP Reward");
    //    }
    //    if(contesttype != ""){
    //        
    //    }else{
    //        valid = 1;
    //        $('#contesttype').html("Please select Contest Type");
    //    }
    //    if(playtype != ""){
    //        
    //    }else{
    //        valid = 1;
    //        $('#playtype').html("Please select Play Type");
    //    }
    //    if(prizetype != ""){
    //        
    //    }else{
    //        valid = 1;
    //        $('#prizetype').html("Please select Prize Type");
    //    }
    //    if(desctext != ""){
    //        
    //    }else{
    //        valid = 1;
    //        $('#desctext').html("Please enter description")
    //    }
    //    
    //    $('.rankamount:visible').each(function(){
    //        var x = $(this).attr('id');
    //        var id = x.replace("rank_amt","");
    //        $('#rank_amt_err'+id).html("");
    //        var rankamount=$.trim($(this).val());
    //       // alert(rankamount);
    //        if(rankamount != ""){
    //            if(number.test(rankamount)){
    //                
    //            }else{
    //                valid = 1;
    //                $('#rank_amt_err'+id).html("Please enter only Numbers");
    //            }
    //        }else{
    //            valid = 1;
    //            $('#rank_amt_err'+id).html("Please enter Rank Amount");
    //        }
    //        
    //       
    //    });
    //    $('.rankto:visible').each(function(){
    //        var x = $(this).attr('id');
    //        var id = x.replace("rank_to","");
    //        $('#rank_to_err'+id).html("");
    //        var rankto=$.trim($(this).val());
    //        if(rankto != ""){
    //            
    //        }else{
    //            valid = 1;
    //            $('#rank_to_err'+id).html("Please select Rank To");
    //        }
    //       
    //       
    //    });
    //    $('.rankfrom:visible').each(function(){
    //        var x = $(this).attr('id');
    //        var id = x.replace("rank_frm","");
    //        $('#rank_from_err'+id).html("");
    //        var rankfrom=$.trim($(this).val());
    //        if(rankfrom != ""){
    //            
    //        }else{
    //            valid = 1;
    //            $('#rank_from_err'+id).html("Please select Rank From");
    //        }
    //       
    //    });
    //    
    //   $('.playeramount:visible').each(function(){
    //        $('#plr_amt_err').html("");
    //        var plramt=$.trim($(this).val());
    //        if(plramt != ""){
    //            if(number.test(plramt)){
    //                
    //            }else{
    //                valid = 1;
    //                $('#plr_amt_err').html("Please enter only Numbers");
    //            }
    //        }else{
    //            valid = 1;
    //            $('#plr_amt_err').html("Please enter amount");
    //        }
    //       
    //   });
    //    
    //    
    //   if(!valid){
    //       $('.newcontestform').submit();
    //   } 
    //    
    //});

    /*
 * Developer: Abhinish Kumar Singh
 * Date: 30/07/2014
 * Description: This function validates form in edit-disability section of player
 *              settings(admin).
 */
    $(".editdisabilityform").validate({
        rules: {
            player_name: {
                required: true,
                regex: /^[a-zA-Z][a-zA-Z ]+$/
            },
            age: {
                required: true,
                regex: /^\d+$/
            }            
            
        },
        messages: {
            player_name: {
                required: "Please enter player name",
                regex: "Please enter only alphabets"
            },
            age: {
                required: "Please enter age",
                regex: "Please enter only numbers"
            }
            
        }

    });
    
    
     $(".newticketform").validate({
        rules: {
           ticket_code:{
               required:true, 
                  remote: {
                      url: "./ticket-ajax-handler",
                     type: "post",
                     data: {
                          ticket_code : function() {
                                           return $( "#tcode" ).val();
                                        
                              },
                            ajaxMethod: 'ticketverification' 
                            }
                                    
                        }
            },
            fpp: {
                required: true,
                regex: /^(?:\d*\.\d{1,2}|\d+)$/
            },
            valid_from : {
                required: true
            },
            valid_upto : {
                required: true
            }
//            age: {
//                required: true,
//                regex: /^\d+$/
//            }            
            
        },
        messages: {
            ticket_code:{
               required: "please generate the ticket code", 
                remote: {ticket_code: "code already exists generate another code"}
            },
            fpp: {
                required: "Please enter fpp amount",
                regex: "Please enter valid amount"
            },
            valid_from : {
                required: "Please enter valid from date"
            },
            valid_upto : {
                required: "Please enter valid upto date"
            }
//            age: {
//                required: "Please enter age",
//                regex: "Please enter only numbers"
//            }
            
        }

    });
 /*
 * Developer: Abhinish Kumar Singh
 * Date: 30/07/2014
 * Description: This function is used to validate form in settings section of
 *              site management(admin)
 */    
    $(".settingsdetailsform").validate({
        rules: {
            salary_amount: {
                required: true,
                regex: /^(?:\d*\.\d{1,3}|\d+)$/
            },
            bonus_amount: {
                required: true,
                regex: /^(?:\d*\.\d{1,3}|\d+)$/
            },
            currency_code: {
                required: true,
                regex: /^[A-Z]+$/
            },
            min_deposit: {
                required: true,
                regex: /^(?:\d*\.\d{1,3}|\d+)$/
            },
            contact_number: {
                required: true
            },
            email: {
                required: true,
                email: true
            },
            mailing_address: {
                required: true
            }            
            
        },
        messages: {
            salary_amount: {
                required: "Please enter salary amount",
                regex: "Please enter only numbers(decimal also allowed)"
            },
            bonus_amount: {
                required: "Please enter bonus amount",
                regex: "Please enter only numbers(decimal also allowed)"
            },
            currency_code: {
                required: "Please enter currency code",
                regex: "Please enter only uppercase alphabets"
            },
            min_deposit: {
                required: "Please enter minimum deposit",
                regex: "Please enter only numbers(decimal also allowed)"
            },
            contact_number: {
                required: "Please enter contact number"
            },
            email: {
                required: "Please enter email address",
                email: "Please enter in correct email format"
            },
            mailing_address: {
                required: "Please enter mailing address"
            }
            
        }

    });
});
$(document).ready(function(){
    $(document.body).on('click','#ticket',function(){
         
        if($(this).prop('checked')){
            $('#ticket_id').show();
        }else{
            $('#ticket_id').hide();
        }
    });
});
/*               
 Developer :Ralesh Kumar Jha
 Description: Validation for uploading a player stats
 Dated:        1/10/1    
 */

$(document).ready(function () {
    $('body').on('change','#excelsheet',function(){
        var value = $(this).val(),
        file = value.toLowerCase(),
        extension = file.substring(file.lastIndexOf('.') + 1);
        if((extension==='xlsx')||(extension==='xlsm')||(extension==='xls')){
            $('#errormsg').html('');
        }else{
            $('#errormsg').html('Please select valid file extension *.xlsx or *.xlsm or *.xls only');
        }
                    
    }); 
//    
//    $('#datepicker').click(function(){
//      $('.helpblock').html('');    
//    });
//    
//     $('#datepicker1').click(function(){
//      $('.helpblock').html('');    
//    });
});
 