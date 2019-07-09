var frmvalidator = new Validator("book-detForm");
frmvalidator.EnableOnPageErrorDisplay();
frmvalidator.EnableMsgsTogether();
frmvalidator.addValidation("book_name","req","Please provide book title");
frmvalidator.addValidation("Description","req","Enter a description");
frmvalidator.addValidation("Genre","req","select a type");

input.onblur = function() {
    if (!this.value.includes('@')) { // not email
      // show the error
      this.classList.add("error");
      // ...and put the focus back
      input.focus();
    } else {
      this.classList.remove("error");
    }
  };