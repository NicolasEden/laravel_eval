const formDish = $(`#newDish`);
let elem;
formDish.on("submit", (e) => {
    e.preventDefault()
})
$(`#submit`).on("click", (e) => {
    e.preventDefault()
    let data = {};
    const el = $(e.target);
    const childs = formDish.children();
    elem = childs[1]
    data["name"] = childs[0].childNodes[1].value;
    data["price"] = childs[2].childNodes[1].value;
    data["weight"] = childs[3].childNodes[1].value;
    data["origine"] = childs[4].childNodes[1].value;
    data["type"] = childs[5].childNodes[1].value;
    data["typeFood"] = childs[6].childNodes[1].value;
    data["ingredients"] = [];
    for (const child of childs[1].childNodes[2].childNodes) {
        if(child.childNodes[0].tagName !== "INPUT") data["ingredients"].push(child.childNodes[0].textContent);
    }
    $.ajax({
        url: 'http://localhost:8000/admin/add',
        type: 'post',
        data: {
            data
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        dataType: 'json',
        success: function (data) {
            console.log(data);
        },
        error: function (data){
            console.log(data);
        }
    });
})








/////////////////////////////////////////////////
let backSpace;
const close = '<a class="close"></a>';
const PreTags = $('.tagarea').val().trim().split(" ");

$('.tagarea').after('<ul class="tag-box"></ul>');

$('.tag-box').append('<li class="new-tag"><input list="ingredients" class="input-tag" type="text"></li>');

// Taging
$('.input-tag').bind("keydown", function (kp) {
    var tag = $('.input-tag').val().trim();
    $(".tags").removeClass("danger");
    if(tag.length > 0){
        backSpace = 0;
        if(kp.keyCode  == 13){
            $(".new-tag").before('<li class="tags">'+tag+close+'</li>');
            $(this).val('');
        }}

    else {if(kp.keyCode == 8 ){
        $(".new-tag").prev().addClass("danger");
        backSpace++;
        if(backSpace == 2 ){
            $(".new-tag").prev().remove();
            backSpace = 0;
        }
    }
    }
});
//Delete tag
$(".tag-box").on("click", ".close", function()  {
    $(this).parent().remove();
});
$(".tag-box").click(function(){
    $('.input-tag').focus();
});
// Edit
$('.tag-box').on("dblclick" , ".tags", function(cl){
    var tags = $(this);
    var tag = tags.text().trim();
    $('.tags').removeClass('edit');
    tags.addClass('edit');
    tags.html('<input list="ingredients" class="input-tag" value="'+tag+'" type="text">')
    $(".new-tag").hide();
    tags.find('.input-tag').focus();

    tag = $(this).find('.input-tag').val() ;
    $('.tags').dblclick(function(){
        tags.html(tag + close);
        $('.tags').removeClass('edit');
        $(".new-tag").show();
    });

    tags.find('.input-tag').bind("keydown", function (edit) {
        tag = $(this).val() ;
        if(edit.keyCode  == 13){
            $(".new-tag").show();
            $('.input-tag').focus();
            $('.tags').removeClass('edit');
            if(tag.length > 0){
                tags.html(tag + close);
            }
            else{
                tags.remove();
            }
        }
    });
});
