// var url = "http://localhost/testing/public";
// window.addEventListener('load',function(){
//     $('.btn-like').css('cursor','pointer');
//     $('.btn-dislike').css('cursor','pointer');

//     function like(){
//         //dar like
//         $('.btn-like').unbind('click').click(function(){
//             console.log('like');
//             $(this).addClass('btn-dislike').removeClass('btn-like');
//             $(this).attr('src',url+'/img/hearts-red.png');
//             $.ajax({
//                 url:url+'/like/'+$(this).data('id'),
//                 type:'get',
//                 success:function(response){
//                     if(response.like){
//                         console.log('Has dado like');
//                     }else{
//                         console.log('error al dar like');
//                     }

//                 }
//             });


//             dislike();
//         });


//     }

//     like();

//     function dislike(){
//         //dar dislike
//         $('.btn-dislike').unbind('click').click(function(){
//             console.log('dislike');
//             $(this).addClass('btn-like').removeClass('btn-dislike');
//             $(this).attr('src',url+'/img/hearts-black.png');
//             $.ajax({
//                 url:url+'/dislike/'+$(this).data('id'),
//                 type:'get',
//                 success:function(response){
//                     if(response.like){
//                         console.log('Has dado dislike');
//                     }else{
//                         console.log('error al dar dislike');
//                     }

//                 }
//             });

//             like();
//         });

//     }

//     dislike();


//     $('#buscar').submit(function(){

//         $(this).attr('action',url+'/users/'+$('#buscar #user').val());

//     });
// });

var url = "http://localhost/testing/public";
/*
window.addEventListener('load',function(){
    $('.btn-like').css('cursor','pointer');
    $('.btn-dislike').css('cursor','pointer');

    function like(){
        //dar like
        $('.btn-like').unbind('click').click(function(){
            console.log('like');
            $(this).addClass('btn-dislike').removeClass('btn-like');
            $(this).attr('src',url+'/img/hearts-red.png');
            $.ajax({
                url:url+'/like/'+$(this).data('id'),
                type:'get',
                success:function(response){
                    if(response.like){
                        console.log('Has dado like');
                    }else{
                        console.log('error al dar like');
                    }

                }
            });


            countLike($(this).data('id'));
            dislike();
        });


    }

    like();

    function dislike(){
        //dar dislike
        $('.btn-dislike').unbind('click').click(function(){
            console.log('dislike');
            $(this).addClass('btn-like').removeClass('btn-dislike');
            $(this).attr('src',url+'/img/hearts-black.png');
            $.ajax({
                url:url+'/dislike/'+$(this).data('id'),
                type:'get',
                success:function(response){
                    if(response.like){
                        console.log('Has dado dislike');
                    }else{
                        console.log('error al dar dislike');
                    }

                }
            });
            countLike($(this).data('id'));
            like();
        });

    }

    dislike();


    $('#buscar').submit(function(){

        $(this).attr('action',url+'/users/'+$('#buscar #user').val());

    });
}); */

// $('#buscador').on('submit',(function(){
    
//     $(this).attr('action',url+'/users/'+$('#buscador #user').val());

// }));

function buscar(){
    var buscador = getElementById('buscador').attr('action',url+'/users/');
}

async function like(post_id){
    const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;
    const res = await fetch('http://localhost/testing/public/like/'+post_id,{
        method:'GET',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        }
    });

    const data = await res.json().then((json)=>{
        console.log(JSON.stringify(json,null,2));
        if(json.message=='0'){
            console.log('DISLIKE');
            document.getElementById('btn-like'+post_id).src=url+'/img/hearts-black.png';
        }
        if(json.message=='1'){
            console.log('LIKE');
            document.getElementById('btn-like'+post_id).src=url+'/img/hearts-red.png';
        }
        countLike(post_id);
    });



}

/* async function dislike(post_id){
    const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;
    const res = await fetch('http://localhost/testing/public/dislike/'+post_id,{
        method:'GET',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        }
    });
    const data = res.json().then((json)=>{
        countLike(post_id);
    });

} */


async function countLike(post_id){
    const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;
    try {
        const res = await fetch('http://localhost/testing/public/getlike/'+post_id,{
            method:'GET',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            }
        });
        const reslikes = await res.json();
        if(reslikes.likes){
            console.log(JSON.stringify(reslikes,null,2));
            console.log('Likes del post: '+Object.keys(reslikes.likes).length);
            document.getElementById('number-likes-'+post_id).innerHTML=''+Object.keys(reslikes.likes).length;

        }else{
            console.log(reslikes.error);
        }
    } catch (error) {
        console.log(error);
    }


}
