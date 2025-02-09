const keywords = [
    { keyword: "c programming", href: "c_programming.html" },
    { keyword: "mathematics-1", href: "#" },
    { keyword: "basic electrical engineering", href: "#" },
    { keyword: "engineering garphics", href: "#" },
    { keyword: "physics", href: "#" },
    { keyword: "chemistry", href: "#" },
    { keyword: "english", href: "#" },
    { keyword: "mathematics-2", href: "index.html" },
    { keyword: "python", href: "about.html" },

];

const searchInput = document.getElementById("searchInput");
const suggestions = document.querySelector(".suggestions");

searchInput.addEventListener("input", () => {
    const searchTerm = searchInput.value.toLowerCase();
    suggestions.innerHTML = "";

    if (searchTerm) {
        const matchingKeywords = keywords.filter(keyword => keyword.keyword.includes(searchTerm));

        if (matchingKeywords.length > 0) {
            matchingKeywords.forEach(keyword => {
                const listItem = document.createElement("li");
                listItem.textContent = keyword.keyword;
                listItem.addEventListener("click", () => {
                    searchInput.value = keyword.keyword;
                    suggestions.style.display = "none";
                    window.location.href = keyword.href;
                });
                suggestions.appendChild(listItem);
            });

            suggestions.style.display = "block";
        } else {
            suggestions.style.display = "none";
        }
    } else {
        suggestions.style.display = "none";
    }
});
function handleSearch() {
    const searchTerm = searchInput.value.toLowerCase();
    const selectedKeyword = keywords.find(keyword => keyword.keyword === searchTerm);
    if (selectedKeyword) {
        window.location.href = selectedKeyword.href;
    }
}
document.getElementById("searchButton").addEventListener("click", handleSearch);
searchInput.addEventListener("keydown", event => {
    if (event.key === "Enter") {
        handleSearch();
    }
});
document.addEventListener("click", (event) => {
    if (!searchInput.contains(event.target)) {
        suggestions.style.display = "none";
    }
});

// auto disappear
searchInput.addEventListener("input", () => {
    setTimeout(() => {
        suggestions.style.display = "none";
    }, 10000);
});





