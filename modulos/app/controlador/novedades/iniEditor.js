export function iniEditor(_id_textarea, _size) {
  CKEDITOR.replace(_id_textarea, {
    allowedContent: true,
    on: {
      instanceReady: function () {},
    },
  });

  CKEDITOR.config.height = _size;
  CKEDITOR.config.width = 'auto';
}
