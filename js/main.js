// 옵션 선택 함수
function addOption(option) {
  switch (option) {
    case "MBA":
      option = "MBA"
      break;
    case "Invariant":
      option = "Invariant"
      break;
    case "Contextual":
      option = "Contextual"
      break;
    case "Dynamic":
      option = "Dynamic"
      break;
    case "Inline Assembly":
      option = "ASM"
      break;
    case "Rename Identifier":
      option = "Var"
      break;
    case "Code Uglyfier":
      option = "Ugly"
      break;
  }
  if (location.hash == "#source") {
    var textValue = document.getElementsByClassName("option_text")[0].value + " -" + option;
    document.getElementsByClassName("option_text")[0].value = textValue;
  } else {
    var textValue = document.getElementsByClassName("option_text")[1].value + " -" + option;
    document.getElementsByClassName("option_text")[1].value = textValue;
  }
}

// option 패널 열고 닫는 함수
function panelOpenClose(evt) {
  var targetPanel = evt.target.nextElementSibling;
  if (targetPanel.style.display == "none") {
    targetPanel.style.display = "block";
  } else {
    targetPanel.style.display = "none";
  }
}

// 현재 location.hash 값을 통해 탭 색깔 전환
function changeTab(id) {
  if (id == "source_header") {
    document.getElementById("source_header").className = "current";
    document.getElementById("binary_header").className = "not_current";
  } else if (id == "binary_header") {
    document.getElementById("source_header").className = "not_current";
    document.getElementById("binary_header").className = "current";
  }
}

// 파일 업로드 후 수정
function fileUploaded(id) {
  console.log(id);
  document.getElementById(id).parentNode.children[2].value = document.getElementById(id).value;
  document.getElementById(id).parentNode.children[2].disabled = true;
}

// 페이지 로딩 후 실행할 동작들
document.addEventListener("DOMContentLoaded", function() {
  // 처음 로드 시 보여줄 페이지 설정
  var current_hash = location.hash;
  if (current_hash == "") {
    location.hash = "#source";
    document.getElementById("source_header").className = "current";
    document.getElementById("binary_header").className = "not_current";
  } else if (current_hash == "#source") {
    document.getElementById("source_header").className = "current";
    document.getElementById("binary_header").className = "not_current";
  } else if (current_hash == "#binary") {
    document.getElementById("source_header").className = "not_current";
    document.getElementById("binary_header").className = "current";
  }

  window.scrollTo({
    top: 0,
    behavior: 'smooth'
  });

  var h4InOption = document.getElementsByClassName("option")[0].getElementsByTagName("h4");
  for (var i = 0; i < h4InOption.length; i++) {
    h4InOption[i].addEventListener("click", panelOpenClose);
  }
  h4InOption = document.getElementsByClassName("option")[1].getElementsByTagName("h4");
  for (var i = 0; i < h4InOption.length; i++) {
    h4InOption[i].addEventListener("click", panelOpenClose);
  }
});
