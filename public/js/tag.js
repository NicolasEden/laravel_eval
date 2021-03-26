//
//                          ┏╋━━━━━━━━━◥◣◆◢◤━━━━━━━━━╋┓
//                              Admin.show.blade.php
//                          ┗╋━━━━━━━━━◢◤◆◥◣━━━━━━━━━╋┛
//
$(`.edit`).on("click", (e) => {
    const element = $(e.target);
    const row = element.parents()[1];
    const id = row.childNodes[17].value;
    window.location.href = `/admin/edit?id=${id}`;
})
$(`.delete`).on("click", (e) => {
    const element = $(e.target);
    const row = element.parents()[1];
    const id = row.childNodes[17].value;
    window.location.href = `/admin/delete?id=${id}`;
})
//
//                          ┏╋━━━━━━━━━◥◣◆◢◤━━━━━━━━━╋┓
//                                Panier.blade.php
//                          ┗╋━━━━━━━━━◢◤◆◥◣━━━━━━━━━╋┛
//
$(`.panierDelete`).on("click", (e) => {
    const element = $(e.target);
    const row = element.parents()[1];
    const id = row.childNodes[17].value;
    window.location.href = `/panier/delete?id=${id}`;
})
//
//                          ┏╋━━━━━━━━━◥◣◆◢◤━━━━━━━━━╋┓
//                                Home.blade.php
//                          ┗╋━━━━━━━━━◢◤◆◥◣━━━━━━━━━╋┛
//
$(`.panierAdd`).on("click", (e) => {
    const element = $(e.target);
    const row = element.parents()[1];
    const id = row.childNodes[17].value;
    window.location.href = `/panier/add?id=${id}`;
})




//
//                          ┏╋━━━━━━━━━◥◣◆◢◤━━━━━━━━━╋┓
//                              Admin.add.blade.php
//                          ┗╋━━━━━━━━━◢◤◆◥◣━━━━━━━━━╋┛
//
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
    data["libelle"] = childs[0].childNodes[1].value;
    data["price"] = childs[2].childNodes[1].value;
    data["weight"] = childs[3].childNodes[1].value;
    data["dishes_origines"] = childs[4].childNodes[1].value;
    data["dishes_types"] = childs[5].childNodes[1].value;
    data["dishes_type_food"] = childs[6].childNodes[1].value;
    data["ingredients"] = [];
    for (const child of childs[1].childNodes[2].childNodes) {
        if(child.childNodes[0].tagName !== "INPUT") data["ingredients"].push(child.childNodes[0].textContent);
    }
    console.log(data)
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
            if (data.success === true) window.location.href = "/admin/show";
        },
        error: function (data){
            alert("Une erreur s'est produite, merci de vérifier vos champs.")
        }
    });
})
//
//                          ┏╋━━━━━━━━━◥◣◆◢◤━━━━━━━━━╋┓
//                              Admin.edit.blade.php
//                          ┗╋━━━━━━━━━◢◤◆◥◣━━━━━━━━━╋┛
//

// Mise en place d'un évènement quand le bouton avec l'ID "edit" est clicker
$(`#edit`).on("click", (e) => {
    e.preventDefault()
    let data = {};
    const el = $(e.target);
    const childs = formDish.children();
    elem = childs[1].childNodes[3]
    data["libelle"] = childs[0].childNodes[1].value; // Récupération du nom du plat
    data["price"] = childs[2].childNodes[1].value; // Récupération du prix
    data["weight"] = childs[3].childNodes[1].value; // Récupération du poid
    data["dishes_origines"] = childs[4].childNodes[1].value; // Récupération de l'origine
    data["dishes_types"] = childs[5].childNodes[1].value; // Récupération du type
    data["dishes_type_food"] = childs[6].childNodes[1].value; // Récupération du type de nourriture
    data["id"] = childs[7].value; // Récupération de l'ID
    data["ingredients"] = [];
    for (const child of childs[1].childNodes[3].childNodes) { // Récupération des ingrédients
        console.log(child.className)
        if(child.className === "tags") data["ingredients"].push(child.childNodes[0].textContent);
    }
    console.log(data)
    $.ajax({ // Création d'un appel pour fournir les informations à l'API
        url: 'http://localhost:8000/admin/edit',
        type: 'post',
        data: {
            data
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        dataType: 'json',
        success: function (data) {
            if (data.success === true) window.location.href = "/admin/show"; // Si il n'y a pas d'erreur rediriger
        },
        error: function (data){
            alert("Une erreur s'est produite, merci de vérifier vos champs.") // Sinon afficher une alerte
        }
    });
})










































































// C'était une technique pour pas faire les commentaires mais tu a vu donc bon...

if ($('.tagarea').html() !== undefined) { // Vérifie si un élément possède la class "tagarea"
    let backSpace;
    const close = '<a class="close"></a>';
    const PreTags = $('.tagarea').val().trim().split(" ");

    if ($('.tag-box').html() === undefined) { // // Vérifie si un élément possède la class "tagarea"
        $('.tagarea').after('<ul class="tag-box"></ul>'); // Implement une liste après l'élément avec la class tagarea
    }
    $('.tag-box').append('<li class="new-tag"><input list="ingredients" class="input-tag" type="text"></li>'); // Implement un element à la liste après l'élément avec la class tagbox

    // Taging
    $('.input-tag').bind("keydown", function (kp) {
        var tag = $('.input-tag').val().trim(); // Tirm la value dans l'elementavec la class -input-tag
        $(".tags").removeClass("danger");
        if (tag.length > 0) {
            backSpace = 0;
            if (kp.keyCode == 13) {
                $(".new-tag").before('<li class="tags">' + tag + close + '</li>');
                $(this).val('');
            }
        } else {
            if (kp.keyCode == 8) {
                $(".new-tag").prev().addClass("danger");
                backSpace++;
                if (backSpace == 2) {
                    $(".new-tag").prev().remove();
                    backSpace = 0;
                }
            }
        }
    });
    //Delete tag
    $(".tag-box").on("click", ".close", function () {
        $(this).parent().remove();
    });
    $(".tag-box").click(function () {
        $('.input-tag').focus();
    });
    // Edit
    $('.tag-box').on("dblclick", ".tags", function (cl) {
        var tags = $(this);
        var tag = tags.text().trim();
        $('.tags').removeClass('edit');
        tags.addClass('edit');
        tags.html('<input list="ingredients" class="input-tag" value="' + tag + '" type="text">')
        $(".new-tag").hide();
        tags.find('.input-tag').focus();

        tag = $(this).find('.input-tag').val();
        $('.tags').dblclick(function () {
            tags.html(tag + close);
            $('.tags').removeClass('edit');
            $(".new-tag").show();
        });

        tags.find('.input-tag').bind("keydown", function (edit) {
            tag = $(this).val();
            if (edit.keyCode == 13) {
                $(".new-tag").show();
                $('.input-tag').focus();
                $('.tags').removeClass('edit');
                if (tag.length > 0) {
                    tags.html(tag + close);
                } else {
                    tags.remove();
                }
            }
        });
    });
}
