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

function obfuscate() {
  console.log("obfuscated!");
  document.getElementById("result_div").style.visibility="visible";
}

// 처음 로드 시 보여줄 페이지
document.addEventListener("DOMContentLoaded", function() {
  var current_hash = location.hash;
  if (current_hash == "") {
    location.hash = "#source";
    document.getElementById("source_header").style.backgroundColor="white";
    document.getElementById("source_header").style.borderBottom="solid white 2px";
  }

  window.scrollTo({top:0, behavior:'smooth'});
});

// function tabChanger() {
//   if(location.hash=="#binary"){
//     console.log("why");
//     document.getElementById("source_header").style.backgroundColor="grey";
//     document.getElementById("source_header").style.borderBottom="none";
//     document.getElementById("binary_header").style.backgroundColor="white";
//     document.getElementById("binary_header").style.borderBottom="solid white 2px";
//   }
//   document.getElementById("source_header").style.backgroundColor="white";
//   document.getElementById("source_header").style.borderBottom="solid white 2px";
//   document.getElementById("binary_header").style.backgroundColor="grey";
//   document.getElementById("binary_header").style.borderBottom="none";
// }
