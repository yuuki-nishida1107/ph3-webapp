const btn =document.querySelector(".button")
const modal =document.querySelector(".js-modal-container")
btn.addEventListener("click",function(){
    modal.classList.add('block')
})
const cbtn =document.querySelector(".responsiveButton")
cbtn.addEventListener("click",function(){
    modal.classList.add('block')
})

const modalBtn =document.querySelector(".js-btn")
modalBtn.addEventListener("click",function(){
    modal.classList.remove('block')
})

const button =document.querySelector(".button-modal")
const completeModal= document.querySelector(".js-complete-container")
const loadingContainer =document.querySelector('.loading-container')
const twitterCheckbox = document.querySelector("#twitter")
button.addEventListener("click",function(){
    // completeModal.classList.add('complete-block')
    // modal.classList.remove('block')
    loadingContainer.classList.add('loading-block')
    if(twitterCheckbox.checked){
        const tweetArea = document.querySelector("#js-tweet-area")
        const tweetContent =`${tweetArea.value}`
        window.open(`http://twitter.com/intent/tweet?&text=${tweetContent}`)
    }
})

const modalCloseBtn =document.querySelector(".js-complete-btn");
modalCloseBtn.addEventListener("click",function(){
    completeModal.classList.remove('complete-block')
})

const animation = document.querySelector('.loading-circle');
animation.addEventListener('animationend',()=>{
    loadingContainer.classList.remove('loading-block')
    completeModal.classList.add('complete-block')
    modal.classList.remove('block')
})

// const twitterCheckbox = document.querySelector("#twitter")
// const tweet =()=>{
//     if(twitterCheckbox.checked){
//         const tweetArea = document.querySelector("#js-tweet-area")
//         const tweetContent =`${tweetArea.value}`
//         window.open(`http://twitter.com/intent/tweet?&text=${tweetContent}`)
//     }
// }

const calender =document.querySelector('#datepicker');
calender.addEventListener('click',()=>{

})
$('#datepicker').datepicker();
