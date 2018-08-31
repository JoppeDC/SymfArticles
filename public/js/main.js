const articles = document.getElementById("articles");

if(articles){
    articles.addEventListener('click',(e) => { //Is er geklikt op de tabel?
        if(e.target.className === 'btn btn-danger delete-article') { // is er geklikt op een knop?
            if(confirm('Ben je zeker?')){ //Bevestiging door de gebruiker
                const id = e.target.getAttribute('data-id');
                fetch(`/article/delete/${id}`, {
                    method: 'DELETE'
                }).then(res => window.location.reload());
            }
        }
    })
}