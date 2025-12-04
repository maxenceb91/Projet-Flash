const chat = document.querySelector('.chat-section')
const btnChat = document.querySelector('.btn-chat')

btnChat.addEventListener('click', () => {
    chat.classList.toggle('chat-active')
    btnChat.classList.toggle('return-i')
})