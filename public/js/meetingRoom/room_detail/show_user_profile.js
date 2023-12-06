// function show_profile_card_for_user(target_userName,target_hashtag,target_id,csrf_token,data) {
//     if (data != null) {
//         $.ajax({
//             type: "POST",
//             headers: {
//             'X-CSRF-TOKEN': csrf_token
//             },
//             url: '/get_user_profiel_and_detail',
//             data: {
//                 _token : csrf_token, 
//                 target_username:target_userName,
//                 target_hashtag:target_hashtag,
//                 target_id:target_id,
//                 user_token:USER_INFO.USER_TOKEN,
//                 username:USER_INFO.USER_NAME,
//                 hashtag:USER_INFO.USER_HAHSTAG,
//                 user_id:USER_INFO.USER_ID,

//             },
//             dataType: "json",
//             success: function(resultData) {show_profile_card_for_user(userName,hashtag,user_id,csrf_token,resultData)}
//         });
//     }else{

//     }
// }