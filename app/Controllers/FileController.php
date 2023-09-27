<?php

namespace App\Controllers;

use App\Models\FileModel;
use App\Models\UserModel;
use App\Models\CommentModel;
use App\Models\LikeModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\Files\File;

class FileController extends BaseController {

    public function index() {
        $files = new FileModel();
        $session = session();

        $data['files'] = $files->findAll();

        $session->set($data);

        return view('dashboard/home', $data);
    }

    public function viewImages() {
        $session = session();

        $data = $session->get();

        $data['files'] = $this->filterImages($data['files']);

        return view('dashboard/images', $data);
    }
    public function filterImages($files) {
        $tempFiles = array();

        forEach($files as $file) {
            if ($file['fileType'] == 'jpg' || $file['fileType'] == 'jpeg' || $file['fileType'] == 'png' || $file['fileType'] == 'gif') {
                array_push($tempFiles, $file);
            }
        }

        return $tempFiles;
    }

    public function viewAudios() {
        $session = session();

        $data = $session->get();

        $data['files'] = $this->filterAudios($data['files']);

        return view('dashboard/audios', $data);
    }
    public function filterAudios($files) {
        $tempFiles = array();

        forEach($files as $file) {
            if ($file['fileType'] == 'mp3' || $file['fileType'] == 'wav') {
                array_push($tempFiles, $file);
            }
        }

        return $tempFiles;
    }

    public function viewVideos() {
        $session = session();

        $data = $session->get();

        $data['files'] = $this->filterVideos($data['files']);

        return view('dashboard/videos', $data);
    }
    public function filterVideos($files) {
        $tempFiles = array();

        forEach($files as $file) {
            if ($file['fileType'] == 'mp4') {
                array_push($tempFiles, $file);
            }
        }

        return $tempFiles;
    }

    public function create()
    {
        return view('dashboard/upload');
    }

    public function store()
    {
        $files = new FileModel();

        $validationRule = [
            'file' => [
                'rules' => [
                    'uploaded[file]',
                    'mime_in[file,image/jpg,image/jpeg,image/gif,image/png,audio/mp3,audio/wav,audio/mp4,video/mp4]',
                    'max_size[file,10000]',
                ],
            ],
        ];

        $file = $this->request->getFile('file');

        if ($file->isValid() && ! $file->hasMoved() && $this->validate($validationRule))
        {
            $fileName = $file->getRandomName();
            $file->move('uploads', $fileName);
            $fileType = $file->getClientExtension();

            $files->storeFile($this->request->getPost('name'), $this->request->getPost('description'), $fileName, $fileType);

            return redirect()->to('dashboard/home')->with('status', 'File Saved.');
        }
        else
        {
            $data['error'] = 'Invalid File.';

            return view('dashboard/upload', $data);
        }
    }

    public function edit($id)
    {
        $files = new FileModel();

        $data['file'] = $files->find($id);

        return view('dashboard/edit', $data);
    }

    public function update($id)
    {
        $files = new FileModel();
        $comments = new CommentModel();

        $file = $files->find($id);
        $oldFileName = $file['fileName'];
        $oldFileType = $file['fileType'];

        $newFile = $this->request->getFile('file');

        if ($newFile->isValid() && ! $newFile->hasMoved())
        {
            if (file_exists("uploads/".$oldFileName))
            {
                unlink("uploads/".$oldFileName);
                $comments->deleteComments($id);
            }

            $newFileName = $newFile->getRandomName();
            $newFileType = $newFile->getClientExtension();
            $newFile->move('uploads/', $newFileName);
        }
        else
        {
            $newFileName = $oldFileName;
            $newFileType = $oldFileType;
        }

        $data = [
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'fileName' => $newFileName,
            'fileType' => $newFileType,
        ];

        $files->update($id, $data);

        return redirect()->to('/dashboard/home')->with('status', 'File Updated.');
    }

    public function delete($id)
    {
        $files = new FileModel();
        $comments = new CommentModel();

        $file = $files->find($id);
        $fileName = $file['fileName'];

        if (file_exists("uploads/".$fileName))
        {
            unlink("uploads/".$fileName);
            $comments->deleteComments($id);
        }

        $files->delete($id);

        return redirect()->to('/dashboard/home')->with('status', 'File Deleted.');

    }

    public function viewComment($id)
    {
        $comments = new CommentModel();
        $files = new FileModel();

        $data = $comments->getComments($id);
        $data['file'] = $files->find($id);

        return view('dashboard/viewComment', $data);
    }

    public function addComment($fileID)
    {
        $session = session();

        $comments = new CommentModel();

        $comments->saveComment($this->request->getPost('description'), $session->get('id'), $fileID, 0);

        return redirect()->to('/dashboard/viewComment/' . $fileID);
    }

    public function addLike($fileID, $commentID)
    {
        $session = session();
        $likes = new LikeModel();
        $comments = new CommentModel();

        $user_id = $session->get('id');

        if ($likes->userCommentExists($user_id, $commentID))
        { // Comment has been liked or disliked by the user
            if ($likes->isLike($user_id, $commentID))
            {
                // If like, do nothing
            }
            else
            {   // If dislike, remove dislike, add like
                $likes->setLike($user_id, $commentID, true);
                $comments->incrementComment($commentID);
                $comments->incrementComment($commentID);
            }
        }
        else
        { // Comment has not been liked or disliked by the user
            $data = [
                'user_id' => $session->get('id'),
                'comment_id' => $commentID,
                'isLike' => true
            ];

            $likes->save($data);

            // Increment comment rating
            $comments->incrementComment($commentID);
        }

        return redirect()->to('/dashboard/viewComment/' . $fileID);
    }

    public function addDislike($fileID, $commentID)
    {
        $session = session();
        $likes = new LikeModel();
        $comments = new CommentModel();

        $user_id = $session->get('id');

        if ($likes->userCommentExists($user_id, $commentID))
        { // Comment has been liked or disliked by the user

            var_dump($likes->isLike($user_id, $commentID));

            if (!$likes->isLike($user_id, $commentID))
            {
                // If dislike, do nothing
            }
            else
            {   // If like, remove like, add dislike
                $likes->setLike($user_id, $commentID, false);
                $comments->decrementComment($commentID);
                $comments->decrementComment($commentID);
            }
        }
        else
        { // Comment has not been liked or disliked by the user
            $data = [
                'user_id' => $session->get('id'),
                'comment_id' => $commentID,
                'isLike' => false
            ];

            $likes->save($data);

            // Decrement comment rating
            $comments->decrementComment($commentID);
        }

        return redirect()->to('/dashboard/viewComment/' . $fileID);
    }

    public function search()
    {
        $search = $this->request->getVar('search');
        $db = new FileModel();

        $data['files'] = $db->getSearchResults($search);

        return view('/dashboard/searchResults', $data);
    }
}
