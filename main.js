function expandFolder(li) {
    if (li.nextElementSibling.classList.contains("expand")) {
        li.nextElementSibling.classList.remove("expand");
    } else {
        li.nextElementSibling.classList.add("expand");
    }
}