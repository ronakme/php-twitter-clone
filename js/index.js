// like function that sends a request to like.php with the user that is
// giving the like and the message that receives it
const likeButtons = document.querySelectorAll('.like-btn.btn-success');
likeButtons.forEach(button => button.addEventListener('click', sendLikeToServer));

function sendLikeToServer(e) {
  const { msg, usr } = e.target.dataset;
  const data = new FormData();
  data.append('from', usr);
  data.append('to', msg);

  fetch('http://localhost:8080/aux/like.php', {
    "method": "POST",
    "body": data
  })
  .then(res => res.json())
  .then(res => {
    if (res === 1) displayLike(msg);
  });
}

function displayLike(id) {
  const button = document.querySelector(`button[data-msg="${id}"]`);
  const span = document.querySelector(`span[data-msg="${id}"]`);

  // Change button style while the page isn't reloaded
  button.textContent = "Dislike";
  button.classList.remove("btn-success");
  button.classList.add("btn-warning");

  // Add one to the likes number while the page isn't reloaded
  let original = +span.textContent;
  span.textContent = original += 1;
}