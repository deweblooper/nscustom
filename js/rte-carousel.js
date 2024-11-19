
// Register button for shortcode [carousel]

(function() {
   tinymce.create('tinymce.plugins.carousel', {
      init : function(ed, url) {
         ed.addButton('carousel', {
            title : 'Carousel gallery',
            image : url+'/carouselbutton.png',
            onclick : function() {
							var ids = prompt("Add image IDs based on gallery shortcode", "1, 2, 3");

							if (ids != null && ids != '') {
							ed.execCommand('mceInsertContent', false, '[carousel link="file" ids="'+ids+'"]');
							}
						}
         });
      },
      createControl : function(n, cm) {
         return null;
      },
      getInfo : function() {
         return {
            longname : "Carousel for Blueimp Gallery",
            author : 'waterwhite',
            authorurl : 'http://www.waterwhite.sk',
            infourl : '',
            version : "1.0"
         };
      }
   });
   tinymce.PluginManager.add('carousel', tinymce.plugins.carousel);
})();