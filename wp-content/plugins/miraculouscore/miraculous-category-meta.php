<?php
if( ! class_exists( 'Miraculous_Taxonomy_Images' ) ) {
  class Miraculous_Taxonomy_Images {
    
    public function __construct() {
		//
    }

    /**
     * Initialize the class and start calling our hooks and filters
     */
	public function init() {
		// Image actions
		add_action( 'genre_add_form_fields', array( $this, 'add_category_image' ), 10, 2 );
		add_action( 'location_add_form_fields', array( $this, 'add_category_image' ), 10, 2 );
		add_action( 'created_genre', array( $this, 'save_category_image' ), 10, 2 );
		add_action( 'created_location', array( $this, 'save_category_image' ), 10, 2 );
		add_action( 'genre_edit_form_fields', array( $this, 'update_category_image' ), 10, 2 );
		add_action( 'location_edit_form_fields', array( $this, 'update_category_image' ), 10, 2 );
		add_action( 'edited_genre', array( $this, 'updated_category_image' ), 10, 2 );
		add_action( 'edited_location', array( $this, 'updated_category_image' ), 10, 2 );

		add_action( 'admin_enqueue_scripts', array( $this, 'load_media' ) );
		add_action( 'admin_footer', array( $this, 'add_script' ) );
   }

   public function load_media() {
		if( ! isset( $_GET['taxonomy'] ) ) {
			return;
		}
		wp_enqueue_media();
   }
  
   /**
    * Add a form field in the new category page
    */
public function add_category_image( $taxonomy ) { ?>
	<div class="form-field term-group">
		 <label for="miraculous-taxonomy-image-id">
		  <?php esc_html_e( 'Image', 'miraculous' ); ?>
		 </label>
		 <input type="hidden" id="miraculous-taxonomy-image-id" name="miraculous-taxonomy-image-id" class="custom_media_url" value="">
		 <div id="category-image-wrapper"></div>
		 <p>
		 <input type="button" class="button button-secondary miraculous_tax_media_button" id="miraculous_tax_media_button" name="miraculous_tax_media_button" value="<?php esc_html_e( 'Add Image', 'miraculous' ); ?>" />
		 <input type="button" class="button button-secondary miraculous_tax_media_remove" id="miraculous_tax_media_remove" name="miraculous_tax_media_remove" value="<?php esc_html_e( 'Remove Image', 'miraculous' ); ?>" />
		 </p>
	 </div>
  <?php }

   /**
    * Save the form field
    */
	public function save_category_image( $term_id, $tt_id ) {
		if( isset( $_POST['miraculous-taxonomy-image-id'] ) && '' !== $_POST['miraculous-taxonomy-image-id'] ){
			add_term_meta( $term_id, 'miraculous-taxonomy-image-id', absint( $_POST['miraculous-taxonomy-image-id'] ), true );
		}
	}

    /**
     * Edit the form field
     */
    public function update_category_image( $term, $taxonomy ) { ?>
      	<tr class="form-field term-group-wrap">
	        <th scope="row">
	          <label for="miraculous-taxonomy-image-id">
			    <?php esc_html_e( 'Image', 'miraculous' ); ?>
			  </label>
	        </th>
	        <td>
	        <?php 
			 $image_id = get_term_meta( $term->term_id, 'miraculous-taxonomy-image-id', true );
			?>
	         <input type="hidden" id="miraculous-taxonomy-image-id" name="miraculous-taxonomy-image-id" value="<?php echo esc_attr( $image_id ); ?>">
		      <div id="category-image-wrapper">
				<?php if( $image_id ) { ?>
				  <?php echo wp_get_attachment_image( $image_id, 'thumbnail' ); ?>
				<?php } ?>
			   </div>
	           <p>
	            <input type="button" class="button button-secondary miraculous_tax_media_button" id="miraculous_tax_media_button" name="miraculous_tax_media_button" value="<?php esc_html_e( 'Add Image', 'miraculous' ); ?>" />
	            <input type="button" class="button button-secondary miraculous_tax_media_remove" id="miraculous_tax_media_remove" name="miraculous_tax_media_remove" value="<?php esc_html_e( 'Remove Image', 'miraculous' ); ?>" />
	           </p>
	       </td>
      	</tr>

   <?php }

   /**
    * Update the form field value
    */
	public function updated_category_image( $term_id, $tt_id ) {
		if( isset( $_POST['miraculous-taxonomy-image-id'] ) && '' !== $_POST['miraculous-taxonomy-image-id'] ){
			update_term_meta( $term_id, 'miraculous-taxonomy-image-id', absint( $_POST['miraculous-taxonomy-image-id'] ) );
		} else {
			update_term_meta( $term_id, 'miraculous-taxonomy-image-id', '' );
		}
	}
 
   /**
    * Enqueue styles and scripts
    */
   public function add_script() {
     if( ! isset( $_GET['taxonomy'] ) ) {
       return;
     } ?>
     <script> 
	 jQuery(document).ready( function($) {
       _wpMediaViewsL10n.insertIntoPost = '<?php _e( "Insert", "miraculous" ); ?>';
       function ct_media_upload(button_class) {
         var _custom_media = true, _orig_send_attachment = wp.media.editor.send.attachment;
         $('body').on('click', button_class, function(e) {
           var button_id = '#'+$(this).attr('id');
           var send_attachment_bkp = wp.media.editor.send.attachment;
           var button = $(button_id);
           _custom_media = true;
           wp.media.editor.send.attachment = function(props, attachment){
             if( _custom_media ) {
               $('#miraculous-taxonomy-image-id').val(attachment.id);
               $('#category-image-wrapper').html('<img class="custom_media_image" src="" style="margin:0;padding:0;max-height:100px;float:none;" />');
               $( '#category-image-wrapper .custom_media_image' ).attr( 'src',attachment.url ).css( 'display','block' );
             } else {
               return _orig_send_attachment.apply( button_id, [props, attachment] );
             }
           }
           wp.media.editor.open(button); return false;
         });
       }
       ct_media_upload('.miraculous_tax_media_button.button');
       $('body').on('click','.miraculous_tax_media_remove',function(){
         $('#miraculous-taxonomy-image-id').val('');
         $('#category-image-wrapper').html('<img class="custom_media_image" src="" style="margin:0;padding:0;max-height:100px;float:none;" />');
       });
       
       $(document).ajaxComplete(function(event, xhr, settings) {
         var queryStringArr = settings.data.split('&');
         if( $.inArray('action=add-tag', queryStringArr) !== -1 ){
           var xml = xhr.responseXML;
           $response = $(xml).find('term_id').text();
           if($response!=""){
             /* Clear the thumb image */
             $('#category-image-wrapper').html('');
           }
          }
        });
      });
    </script>
   <?php }
  }
$Miraculous_Taxonomy_Images = new Miraculous_Taxonomy_Images();
$Miraculous_Taxonomy_Images->init(); }
?>