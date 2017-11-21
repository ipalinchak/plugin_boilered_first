<?php namespace Permmerce\PluginBoilerNew\Admin;


use Permmerce\PluginBoilerNew\FileManager;

class MetaData
{

    const META_KEY_HIDDEN = '_some_Hidden_meta_of_post';
    const NOT_HIDDEN = 'public_meta_post';

    /**
     * @var FileManager
     */
    private $fileManager;

    public function __construct(FileManager $fileManager){

        $this->fileManager = $fileManager;
        add_action('add_meta_boxes', [$this, 'metaBoxes'], 'palinchak_post_type', 2);
        add_action('save_post', [$this, 'updatePostMeta']);
    }

    public function updatePostMeta($postId){

        $post_type = get_post_type($postId);

        if("palinchak_post_type" != $post_type){
            return;
        }

        if(isset($_POST[ self::META_KEY_HIDDEN ])){
            $value = $_POST[ self::META_KEY_HIDDEN ];
            update_post_meta($postId, self::META_KEY_HIDDEN, $value);
        }

        if(isset($_POST[ self::NOT_HIDDEN ])){
            $value2 = $_POST[ self::NOT_HIDDEN ];
            update_post_meta($postId, self::NOT_HIDDEN, $value2);
        }

    }

    public function metaBoxes($postType, $post){

        if ('palinchak_post_type' === $postType) {
        add_meta_box(
            'integrationsecurity',
            __('MetaBox for my post Type'),
            [$this, 'renderMetaBox'],
            'palinchak_post_type'
        );
        }

    }

    public function renderMetaBox($post){

        $value = get_post_meta($post->ID, self::META_KEY_HIDDEN, true);
        $value2 = get_post_meta($post->ID, self::NOT_HIDDEN, true);

        $key = self::META_KEY_HIDDEN;
        echo "<p><input type='text' name='{$key}' value='{$value}'></p>";
        $key2 = self::NOT_HIDDEN;
        echo "<p><input type='text' name='{$key2}' value='{$value2}'></p>";



    }
}
