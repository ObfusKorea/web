// 옵션 선택 함수
function addOption(option) {
  switch (option) {
    case "mba":
      option = "MBA"
      break;
    case "invariant":
      option = "Invariant"
      break;
    case "contextual":
      option = "Contextual"
      break;
    case "dynamic":
      option = "Dynamic"
      break;
    case "asm":
      option = "ASM"
      break;
    case "ctype":
      option = "CTYPE"
      break;
    case "var":
      option = "Var"
      break;
    case "ugly":
      option = "Ugly"
      break;

    default:

  }
  const textValue = document.getElementById("optionText").value + " -" + option;
  document.getElementById("optionText").value = textValue;
}

function panelOpenClose() {
  
}

// 처음 로드 시 보여줄 페이지
var current_hash = location.hash;
if (current_hash == "") {
  location.hash = "#source";
}
