function onlyOne(checkbox) {
    var checkboxes = document.getElementsByName('grade')
    checkboxes.forEach((item) => {
        if (item !== checkbox) item.checked = false
    })
}