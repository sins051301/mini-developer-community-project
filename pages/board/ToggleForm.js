function toggleForm() {
    var form = document.querySelector('.comment-form');
    form.style.display = form.style.display === 'none' ? 'block' : 'none';
}

// 이 부분은 실제로 댓글을 서버에 보내는 등의 작업을 처리할 수 있습니다.
document.getElementById('commentForm').addEventListener('submit', function(event) {
    event.preventDefault();
    var comment = this.querySelector('textarea').value;
    // 여기에 댓글을 처리하는 코드를 작성합니다.
    console.log("댓글 등록: " + comment);
    // 댓글을 처리한 후에는 폼을 다시 숨길 수 있습니다.
    this.parentNode.style.display = 'none';
});