const search = $(`#search`);

search.on("input", function(e) {
    if (this.value.length > 0) $(`#search`).attr("list", "ingredients");
    else $(`#search`).attr("list", "");
    const emojis = ["🍕 ", "🍑 ", "🏳 ", "🍽 ", "🌾 "];
    for (const focus of emojis) {
        search.val(search.val().replace(focus, ""))
    }
})
search.on("click", function(e) {
    this.focus();
})
