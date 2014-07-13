$.each({
	status: function(text_box_id){
				
	},
	hide_photo_video_field_of_status:function(text_box_id){
		
		$("#status-bar-photo-btn").click(function(){
			if($(".status-bar div.atk-form-row-upload").css('display') == 'none') { 
  				$(".status-bar div.atk-form-row-upload").css('display','block'); 
  			} else { 
    				$(".status-bar div.atk-form-row-upload").css('display','none');
 					}					
		});

		$("#status-bar-video-btn").click(function(){
			if($(".status-bar div.atk-form-row-line").css('display') == 'none') {
				$(".status-bar div.atk-form-row-line").css('display','block');
			}else{
				$(".status-bar div.atk-form-row-line").css('display','none');		
			}
		});
	},

	like_me: function(activity_id){
		$.univ().ajaxec('index.php?page=xsocialApp_page_activityHandler&cut_page=1&task=like_me&activity_id='+activity_id+'&subpage=xsocial-junk');
	},


	
	edit_me: function(activity_edit_id){
		$('#say_something_edit').val($('.activity-'+activity_edit_id+'-text').html().trim());
		$('#visibility_edit').val($('#activity_view_'+activity_edit_id).attr('visibility'));

		var dialog = $('.edit-activity-div').dialog({
			buttons: {
				"Save": function() {
					$( dialog ).dialog( "close" );
					$.ajax({
						url: 'index.php?page=xsocialApp_page_activitypages_editactivity&epan=web&subpage=xsocial-junk&cut_page=1',
						type: 'POST',
						data: {activity_id: activity_edit_id,say_something: $('#say_something_edit').val(), visibility: $('#visibility_edit').val()}
					})
					.done(function(ret) {
						eval(ret);
						console.log(ret);
					})
					.fail(function() {
						$(this).univ().errorMessage('Oops, Activity was not edited');
					})
					.always(function() {
						console.log("complete");
					});
					
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});

	},

	edit_post_card:function(postcard_edit_id){
		$('#say_something_edit_postcard').val($('#postcard-text-'+postcard_edit_id).html().trim());
		
		var dialog = $('.edit-postcard-div').dialog({
			buttons: {
				"Save": function() {
					$( dialog ).dialog( "close" );
					$.ajax({
						url: 'index.php?page=xsocialApp_page_activitypages_editactivity&epan=web&subpage=xsocial-junk&cut_page=1',
						type: 'POST',
						data: {activity_id: postcard_edit_id,say_something: $('#say_something_edit_postcard').val()}
					})
					.done(function(ret) {
						eval(ret);
						console.log(ret);
					})
					.fail(function() {
						$(this).univ().errorMessage('Oops, Postcard was not edited');
					})
					.always(function() {
						console.log("complete");
					});
					
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		// alert($('#say_something_edit_postcard').val());
	},
	remove_me: function(activity_id){
		if(confirm('Are you sure to delete this post')){
			$.univ().successMessage('Deleting Activity');
			$.univ().ajaxec('index.php?page=xsocialApp_page_activityHandler&cut_page=1&task=remove_me&activity_id='+activity_id+'&subpage=xsocial-junk');
		}
	},
	share_me: function(activity_to_share_id){
		/*
			open a dialog Box
			create/ move a form in here

		*/
		$('#say_something_share').val('');

		var dialog = $('.xsocial-share-div').dialog({
			buttons: {
				"Share": function() {
					$( dialog ).dialog( "close" );
					$.ajax({
						url: 'index.php?page=xsocialApp_page_activitypages_share&epan=web&subpage=xsocial-dashboard&cut_page=1',
						type: 'POST',
						data: {activity_id: activity_to_share_id,say_something: $('#say_something_share').val(), visibility: $('#visibility_share').val()}
					})
					.done(function(ret) {
						eval(ret);
						console.log(ret);
					})
					.fail(function() {
						$(this).univ().errorMessage('Oops, Activity was not shared');
					})
					.always(function() {
						console.log("complete");
					});
					
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});

		// $(this).univ().frameURL('MyPopup','index.php?page=xsocialApp_page_activitypages_share&epan=web&subpage=xsocial-dashboard&activity_id='+activity_id,{
		// 	close: function(ev){
		// 		$(this).univ().successMessage('You just Shared an activity');
		// 	}
		// });
	},

	autoreloadActivities: function(g,g_name,g_name_offset){
		$(this).univ().successMessage('Loading More... wait');
		if ($(window).scrollTop() + $(window).height() == $(document).height()){$(g).atk4_reload('index.php?epan=web&subpage=xsocial-dashboard&cut_object='+g_name,{g_name_offset:$(g).attr('offset')},null)};
	},
	myReload: function (obj, current_url){
		ev.preventDefault();
		ev.stopPropagation();
		$(obj).atk4_reload(current_url + '&cut_object='+obj,[],null);
	},

	editComment:function(comment_activity_edit_id){

		$('#say_something_edit_comment').val($('#comment-text-'+comment_activity_edit_id).html().trim());

		var dialog = $('.edit-comment-div').dialog({
			buttons: {
				"Save": function() {
					$( dialog ).dialog( "close" );
					$.ajax({
						url: 'index.php?page=xsocialApp_page_activitypages_editactivity&epan=web&subpage=xsocial-junk&cut_page=1',
						type: 'POST',
						data: {activity_id: comment_activity_edit_id,say_something: $('#say_something_edit_comment').val()}
					})
					.done(function(ret) {
						eval(ret);
						console.log(ret);
					})
					.fail(function() {
						$(this).univ().errorMessage('Oops, Activity was not edited');
					})
					.always(function() {
						console.log("complete");
					});
					
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
	},
	showCommentsForm: function(activity_id){
		if($('.comment-form-div').attr('in_activity') == activity_id){
			$('.comment-form-div').toggle();
		}else{
			$('.comments-block-'+activity_id).append($('.comment-form-div'));
			$('.comment-form-div').attr('in_activity',activity_id);
			$('.comment-form-div').find('input.comment_activity_id_input').val(activity_id);
			$('.comment-form-div').show();
		}
	},
	subscribe_news: function() {
        $(this).univ().frameURL('MyPopup', 'index.php?page=xsocialApp_page_news_category&epan=web&subpage=xsocial-dashboard&cut_page=1', {

        });
    },
    AmountRangeSlider: function(div,field, value_div, minV,maxV){
		$( value_div ).html( "Rs " + minV + "/- to Rs " + maxV + "/-" );
    	 $( div ).slider({
			orientation: "horizontal",
			range: true,
			values: [ minV, maxV ],
			max: maxV,
			slide: function( event, ui ) {
					$( field ).val( "" + ui.values[ 0 ] + ":" + ui.values[ 1 ] );
					$( value_div ).html( "Rs " + ui.values[ 0 ] + "/- to Rs " + ui.values[ 1 ]+ "/-" );
				}
			});
    },
    copyBillingAddress:function(b_a,b_l,b_c,b_s,b_country,b_p,s_a,s_l,s_c,s_s,s_country,s_p){
  		$(s_a).val($(b_a).val());
  		$(s_s).val($(b_s).val());
  		$(s_l).val($(b_l).val());
  		$(s_c).val($(b_c).val());
  		$(s_country).val($(b_country).val());
  		$(s_p).val($(b_p).val());
    }

    
},$.univ._import);

$(function () { 
	$("[data-toggle='tooltip']").tooltip();

});

