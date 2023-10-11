//Navigator Object properties
function areCookiesEnabled() {
	let cookEnab = navigator.cookieEnabled;
	let doc = document.getElementById("cookieMessage");
	let but = document.getElementById("cookieButton");
	let message;
	if (cookEnab) {
		message = "Your cookies are enabled";
	} else {
		message = "Your cookies are not enabled";
	}
	if (doc.innerHTML == "") {
		doc.innerHTML = message;
		but.innerHTML = "Hide";
	} else {
		doc.innerHTML = "";
		but.innerHTML = "Show me";
	}
}

function appInformation() {
	let appInfo = navigator.appVersion;
	let doc = document.getElementById("appMessage");
	let but = document.getElementById("infoButton");
	if (doc.innerHTML == "") {
		doc.innerHTML = "Here is your browser information: " + appInfo;
		but.innerHTML = "Hide";
	} else {
		doc.innerHTML = "";
		but.innerHTML = "Show me";
	}
}

function platformInformation() {
	let plat = navigator.platform;
	let doc = document.getElementById("platformMessage");
	let but = document.getElementById("platformButton");
	if (doc.innerHTML == "") {
		doc.innerHTML = "Your operating system is: " + plat;
		but.innerHTML = "Hide";
	} else {
		doc.innerHTML = "";
		but.innerHTML = "Show me";
	}
}

function langInformation() {
	let lang = navigator.language;
	let doc = document.getElementById("langMessage");
	let but = document.getElementById("langButton");
	if (doc.innerHTML == "") {
		doc.innerHTML = "the language you are using is " + lang;
		but.innerHTML = "Hide";
	} else {
		doc.innerHTML = "";
		but.innerHTML = "Show me";
	}
}

function isBrowserOnline() {
	let isOnline = navigator.onLine;
	let doc = document.getElementById("onlineMessage");
	let but = document.getElementById("onlineButton");
	let message;
	if (isOnline) {
		message = "Your browser is online.";
	} else {
		message = "Your browser is offline";
	}
	if (doc.innerHTML == "") {
		doc.innerHTML = message;
		but.innerHTML = "Hide";
	} else {
		doc.innerHTML = "";
		but.innerHTML = "Show me";
	}
}

//Navigator object methods
function isJavaEnabled() {
	let isJava = navigator.javaEnabled();
	let doc = document.getElementById("javaMessage");
	let but = document.getElementById("javaButton");
	let message;
	if (isJava) {
		message = "Java is enabled";
	} else {
		message = "Java is not enabled";
	}
	if (doc.innerHTML == "") {
		doc.innerHTML = message;
		but.innerHTML = "Hide";
	} else {
		doc.innerHTML = "";
		but.innerHTML = "Show me";
	}
}
/* This seems to be deprecated
function isTaintEnabled() {
	let isTaint = navigator.taintEnabled();
	let doc = document.getElementById("taintMessage");
	let but = document.getElementById("taintButton");
	let message;
	if (isTaint) {
		message = "Taint is enabled";
	} else {
		message = "Taint is not enabled";
	}
	if (doc.innerHTML == "") {
		doc.innerHTML = message;
		but.innerHTML = "Hide";
	} else {
		doc.innerHTML = "";
		but.innerHTML = "Show me";
	}
}
*/

/* Toggle between showing and hiding the navigation menu links when the user clicks on the hamburger menu / bar icon */
function displayLinks() {
  var hidLinks = document.getElementsByClassName("hiddenLinks");
  for (let i = 0; i < hidLinks.length; i++) {
	if (hidLinks[i].style.display === "block") {
    hidLinks[i].style.display = "none";
  } else {
    hidLinks[i].style.display = "block";
  }
  }
}
  
/*DOM properties and methods*/
function except() {
	const alwaysShow = document.getElementsByClassName("alwaysShow");
	for (let i = 0; i < alwaysShow.length; i++) {
		alwaysShow[i].style.display = "block";
	}
}

function initializePlayground() {
	const paragraphs = document.getElementsByTagName("p");
	const buttons = document.getElementsByTagName("button");
	for (let i = 0; i < paragraphs.length; i++) {
		paragraphs[i].style.display = "none";
	}
	for (let i = 1; i < buttons.length; i++) {
		buttons[i].style.display = "none";
	}
	const alwaysShow = document.getElementsByClassName("alwaysShow");
	for (let i = 0; i < alwaysShow.length; i++) {
		alwaysShow[i].style.display = "block";
	}
	except();
}

function toggleView() {
	const paragraphs = document.getElementsByTagName("p");
	const buttons = document.getElementsByTagName("button");
	let but = document.getElementById("showAllButton");
	if (but.innerHTML == "Show me") {
		but.innerHTML = "Hide All";
	} else {
		but.innerHTML = "Show me";
	}
	for (let i = 0; i < paragraphs.length; i++) {
		if (paragraphs[i].style.display === "block") {
			paragraphs[i].style.display = "none";
		  } else {
			paragraphs[i].style.display = "block";
		  }
	}
	for (let i = 1; i < buttons.length; i++) {
		if (buttons[i].style.display === "block") {
			buttons[i].style.display = "none";
		  } else {
			buttons[i].style.display = "block";
		  }
	}
	except();
}

function changeAttribute() {
	const but = document.getElementById("attributeButton");
	if (but.innerHTML == "Show me") {
		but.innerHTML = "Undo";
		let basicP = document.getElementById("basicp");
		basicP.id = "likeh2";
	} else {
		but.innerHTML = "Show me";
		let basicP = document.getElementById("likeh2");
		basicP.id = "basicp";
	}
	
}


/*animation*/
function myAnimation() {
	
	moveVertical_a("V_a", 1);
	moveVertical_b("V_b", 1);
	moveHorizontal_a("H_a", 1);
	moveHorizontal_b("H_b", 1);
	moveDiagonal_lr_a("LR_a", 1);
	moveDiagonal_lr_b("LR_b", 1);
	moveDiagonal_rl_a("RL_a", 1);
	moveDiagonal_rl_b("RL_b", 1);
	
}

function moveDiagonal_lr_a(Id, it) {
	let id = null;
	const elem = document.getElementById(Id);   
	let pos = 9;
	clearInterval(id);
	id = setInterval(frame, 10);
	function frame() {
	  if (pos == 18) {
		clearInterval(id);
		id = setInterval(emarf, 10);
	  } else {
		pos+=0.125; 
		elem.style.top = pos + "vw"; 
		elem.style.left = pos + "vw"; 
	  }
	}
	function emarf() {
		if (pos == 0) {
		  clearInterval(id);
		  if (it > 0) {
			id = setInterval(frame, 10);
			it--;
		  }
		} else {
		  pos-=0.125; 
		  elem.style.top = pos + "vw"; 
		  elem.style.left = pos + "vw"; 
		}
	  }
}
function moveDiagonal_lr_b(Id, it) {
	let id = null;
	const elem = document.getElementById(Id);   
	let pos = 9;
	clearInterval(id);
	id = setInterval(frame, 10);
	function frame() {
	  if (pos == 0) {
		clearInterval(id);
		id = setInterval(emarf, 10);
	  } else {
		pos-=0.125; 
		elem.style.top = pos + "vw"; 
		elem.style.left = pos + "vw"; 
	  }
	}
	function emarf() {
		if (pos == 18) {
		  clearInterval(id);
		  if (it > 0) {
			id = setInterval(frame, 10);
			it--;
		  }
		} else {
		  pos+=0.125; 
		  elem.style.top = pos + "vw"; 
		  elem.style.left = pos + "vw"; 
		}
	  }
}
function moveDiagonal_rl_a(Id, it) {
	let id = null;
	const elem = document.getElementById(Id);   
	let pos = 9;
	clearInterval(id);
	id = setInterval(frame, 10);
	function frame() {
	  if (pos == 18) {
		clearInterval(id);
		id = setInterval(emarf, 10);
	  } else {
		pos+=0.125; 
		elem.style.top = pos + "vw"; 
		elem.style.right = pos + "vw"; 
	  }
	}
	function emarf() {
		if (pos == 0) {
		  clearInterval(id);
		  if (it > 0) {
			id = setInterval(frame, 10);
			it--;
		  }
		} else {
		  pos-=0.125; 
		  elem.style.top = pos + "vw"; 
		  elem.style.right = pos + "vw"; 
		}
	  }
}
function moveDiagonal_rl_b(Id, it) {
	let id = null;
	const elem = document.getElementById(Id);   
	let pos = 9;
	clearInterval(id);
	id = setInterval(frame, 10);
	function frame() {
	  if (pos == 0) {
		clearInterval(id);
		id = setInterval(emarf, 10);
	  } else {
		pos-=0.125; 
		elem.style.top = pos + "vw"; 
		elem.style.right = pos + "vw"; 
	  }
	}
	function emarf() {
		if (pos == 18) {
		  clearInterval(id);
		  if (it > 0) {
			id = setInterval(frame, 10);
			it--;
		  }
		} else {
		  pos+=0.125; 
		  elem.style.top = pos + "vw"; 
		  elem.style.right = pos + "vw"; 
		}
	  }
}
function moveVertical_a(Id, it) {
	let id = null;
	const elem = document.getElementById(Id);   
	let pos = 9;
	clearInterval(id);
	id = setInterval(frame, 10);
	function frame() {
	  if (pos == 18) {
		clearInterval(id);
		id = setInterval(emarf, 10);
	  } else {
		pos+=0.125; 
		elem.style.top = pos + "vw"; 
	  }
	}
	function emarf() {
		if (pos == 0) {
		  clearInterval(id);
		  if (it > 0) {
			id = setInterval(frame, 10);
			it--;
		  }
		} else {
		  pos-=0.125; 
		  elem.style.top = pos + "vw"; 
		}
	  }
}
function moveVertical_b(Id, it) {
	let id = null;
	const elem = document.getElementById(Id);   
	let pos = 9;
	clearInterval(id);
	id = setInterval(frame, 10);
	function frame() {
	  if (pos == 0) {
		clearInterval(id);
		id = setInterval(emarf, 10);
	  } else {
		pos-=0.125; 
		elem.style.top = pos + "vw"; 
	  }
	}
	function emarf() {
		if (pos == 18) {
		  clearInterval(id);
		  if (it > 0) {
			id = setInterval(frame, 10);
			it--;
		  }
		} else {
		  pos+=0.125; 
		  elem.style.top = pos + "vw"; 
		}
	  }
}
function moveHorizontal_a(Id, it) {
	let id = null;
	const elem = document.getElementById(Id);   
	let pos = 9;
	clearInterval(id);
	id = setInterval(frame, 10);
	function frame() {
	  if (pos == 18) {
		clearInterval(id);
		id = setInterval(emarf, 10);
	  } else {
		pos+=0.125; 
		elem.style.left = pos + "vw"; 
	  }
	}
	function emarf() {
		if (pos == 0) {
		  clearInterval(id);
		  if (it > 0) {
			id = setInterval(frame, 10);
			it--;
		  }
		} else {
		  pos-=0.125; 
		  elem.style.left = pos + "vw"; 
		}
	  }
}
function moveHorizontal_b(Id, it) {
	let id = null;
	const elem = document.getElementById(Id);   
	let pos = 9;
	clearInterval(id);
	id = setInterval(frame, 10);
	function frame() {
	  if (pos == 0) {
		clearInterval(id);
		id = setInterval(emarf, 10);
	  } else {
		pos-=0.125; 
		elem.style.left = pos + "vw"; 
	  }
	}
	function emarf() {
		if (pos == 18) {
		  clearInterval(id);
		  if (it > 0) {
			id = setInterval(frame, 10);
			it--;
		  }
		} else {
		  pos+=0.125; 
		  elem.style.left = pos + "vw"; 
		}
	  }
}




