document.addEventListener("DOMContentLoaded", () => {
  const toDo = document.querySelector("#toDo");
  const addButton = document.querySelector("#addButton");
  const toDoList = document.querySelector("#toDoList");

  addButton.addEventListener("click", (event) => {
    const item = document.createElement("div"); // div

    const checkBox = document.createElement("input"); // 완료
    checkBox.setAttribute("type", "checkbox");

    const text = document.createElement("span"); // 내용
    text.textContent = toDo.value;

    const removeButton = document.createElement("button"); // 삭제
    removeButton.textContent = "삭제";

    removeButton.addEventListener("click", (event) => {
      event.currentTarget.parentNode.parentNode.removeChild(
        event.currentTarget.parentNode
      );
    });

    checkBox.addEventListener("change", (event) => {
      if (checkBox.checked) {
        text.style.textDecorationLine = "line-through";
      } else {
        text.style.textDecorationLine = "none";
      }
    });

    item.appendChild(checkBox);
    item.appendChild(text);
    item.appendChild(removeButton);

    toDoList.appendChild(item);
    toDo.value = "";
  });
  form.addEventListener("submit", (event) => {
    event.preventDefault(); // 폼 제출 기본 동작 중단

    const todoItems = document.querySelectorAll(".todo-item");
    const todoData = [];

    todoItems.forEach((item) => {
      todoData.push(item.querySelector("span").textContent);
    });

    // 폼 데이터 생성
    const formData = new FormData();
    formData.append("todoItems", JSON.stringify(todoData));

    // 폼 전송
    fetch("process_todo.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.text())
      .then((data) => console.log(data))
      .catch((error) => console.error("Error:", error));
  });
});
