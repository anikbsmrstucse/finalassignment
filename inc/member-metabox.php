<?php

      // Meta-Box Generator
      // How to use: $meta_value = get_post_meta( $post_id, $field_id, true );
      // Example: get_post_meta( get_the_ID(), "my_metabox_field", true );

      class custom_urlMetabox {

        private $screens = array('member_post');

        private $fields = array(
          array(
            'label' => 'Degination',
            'id' => 'textarea_degination',
            'type' => 'textarea',
           ),
          array(
            'label' => 'Facebook',
            'id' => 'url_facebook',
            'type' => 'url',
           ),
          array(
            'label' => 'Twitter',
            'id' => 'url_twitter',
            'type' => 'url',
           ),
          array(
            'label' => 'Instagram',
            'id' => 'url_instagram',
            'type' => 'url',
           ),
          array(
            'label' => 'Linkedin',
            'id' => 'url_linkedin',
            'type' => 'url',
           )  
        );

        public function __construct() {
          add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
          add_action( 'save_post', array( $this, 'save_fields' ) );
        }

        public function add_meta_boxes() {
          foreach ( $this->screens as $s ) {
            add_meta_box(
              'custom_url',
              __( 'Custom Feild', 'finalassignment' ),
              array( $this, 'meta_box_callback' ),
              $s,
              'normal',
              'low'
            );
          }
        }

        public function meta_box_callback( $post ) {
          wp_nonce_field( 'custom_url_data', 'custom_url_nonce' ); 
          echo "It's use for display member Deginations and Social url";
          $this->field_generator( $post );
        }

        public function field_generator( $post ) {
          $output = '';
          foreach ( $this->fields as $field ) {
            $label = '<label for="' . $field['id'] . '">' . $field['label'] . '</label>';
            $meta_value = get_post_meta( $post->ID, $field['id'], true );
            if ( empty( $meta_value ) ) {
              if ( isset( $field['default'] ) ) {
                $meta_value = $field['default'];
              }
            }
            switch ( $field['type'] ) {
              case 'textarea':
                $input = sprintf(
                  '<textarea style="width: 100%%" id="%s" name="%s" rows="5">%s</textarea>',
                  $field['id'],
                  $field['id'],
                  $meta_value
                );
                break;
        
              default:
                $input = sprintf(
                '<input %s id="%s" name="%s" type="%s" value="%s">',
                $field['type'] !== 'color' ? 'style="width: 100%"' : '',
                $field['id'],
                $field['id'],
                $field['type'],
                $meta_value
              );
            }
            $output .= $this->format_rows( $label, $input );
          }
          echo '<table class="form-table"><tbody>' . $output . '</tbody></table>';
        }

        public function format_rows( $label, $input ) {
          return '<div style="margin-top: 10px;"><strong>'.$label.'</strong></div><div>'.$input.'</div>';
        }

        

        public function save_fields( $post_id ) {
          if ( !isset( $_POST['custom_url_nonce'] ) ) {
            return $post_id;
          }
          $nonce = $_POST['custom_url_nonce'];
          if ( !wp_verify_nonce( $nonce, 'custom_url_data' ) ) {
            return $post_id;
          }
          if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return $post_id;
          }
          foreach ( $this->fields as $field ) {
            if ( isset( $_POST[ $field['id'] ] ) ) {
              switch ( $field['type'] ) {
                case 'email':
                  $_POST[ $field['id'] ] = sanitize_email( $_POST[ $field['id'] ] );
                  break;
                case 'text':
                  $_POST[ $field['id'] ] = sanitize_text_field( $_POST[ $field['id'] ] );
                  break;
              }
              update_post_meta( $post_id, $field['id'], $_POST[ $field['id'] ] );
            } else if ( $field['type'] === 'checkbox' ) {
              update_post_meta( $post_id, $field['id'], '0' );
            }
          }
        }

      }

      if (class_exists('custom_urlMetabox')) {
        new custom_urlMetabox;
      };
      
      ?>
      