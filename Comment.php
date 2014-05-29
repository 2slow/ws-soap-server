<?php

class Comment {
    /**
     * Get comments by parent id method
     *
     * @param Int $idParent
     * @return Array
     */
    public function get_comments_by_parent_id($idParent) {
        $root = simplexml_load_file('data/comments.xml');
        $comments = [];
        foreach($root->xpath("//comment") as $comment) {
            if(intval($comment['idParent']) === $idParent){
                array_push($comments, array(
                    'author' => (string) $comment->author,
                    'mark' => intval($comment->mark),
                    'comment' => (string) $comment->text)
                );
            }
        }
        return $comments;
    }

    /**
     * Add comment method
     *
     * @param String $id
     * @param Int $idParent
     * @param String $author
     * @param Int $mark
     * @param String $text
     * @return String
     */
    public function add_comment($id, $idParent, $author, $mark, $text) {

        $root = new DOMDocument();
        $root->load('data/comments.xml');
        $comments = $root->getElementsByTagName('comments')->item(0);

        // Create new node with parameters
        $comment = $root->createElement('comment');
        $root->createElement('comment');
        $authorElem = $root->createElement('author', $author);
        $markElem = $root->createElement('mark', $mark);
        $textElem = $root->createElement('text', $text);
        $comment->setAttribute('idParent', $idParent);
        $comment->setAttribute('id', $id);
        $comment->appendChild($authorElem);
        $comment->appendChild($markElem);
        $comment->appendChild($textElem);

        $comments->appendChild($comment);

        // Validation of new element with schema
        if($root->schemaValidate('data/schemaComments.xsd')) {
            $root->save('data/comments.xml');
        } else {
            return "Error: input doesn't match xsd schema rules";
        }
        return $root->saveXML($root);
    }



}