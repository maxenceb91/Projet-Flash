const input = document.getElementById("msg");
const chatContainer = document.querySelector(".chat");

function loadMessages() {
    fetch("/Projet-flash/projet/utils/load_messages.php")
        .then(res => res.text())
        .then(html => {
            chatContainer.innerHTML = html;
            chatContainer.scrollTop = chatContainer.scrollHeight;
        })
        .catch(error => console.error("Erreur chargement messages:", error));
}

input.addEventListener("keydown", (event) => {
    if (event.key === "Enter") {
        event.preventDefault();

        const msg = input.value.trim();
        if (msg.length < 3) return;

        fetch("/Projet-flash/projet/utils/chatSystem.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: "message=" + encodeURIComponent(msg)
        })
        .then(res => res.text())
        .then(response => {
            console.log("Résultat :", response);
            input.value = "";
            loadMessages();
        })
        .catch(error => console.error("Erreur :", error));
    }
});

setInterval(loadMessages, 10);