export class ReportesVisorClass {
  constructor(_class_) {
    this.#actionListener(_class_);
    this.iniBuscador(_class_);
  }
  iniBuscador(_class_) {
    _class_.formularioSubmit(true);
  }
  // private
  #actionListener(_class_ = this) {
    $("#form_0_buscador").on("submit", function (e) {
      _class_.formularioSubmit(true);
      e.preventDefault();
      return false;
    });
  }
}
