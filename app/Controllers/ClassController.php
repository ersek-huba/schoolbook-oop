<?php
namespace App\Controllers;
use App\Models\ClassModel;
use App\Views\Display;

class ClassController extends Controller {

    public function __construct()
    {
        $class = new ClassModel();
        parent::__construct($class);
    }

    public function index(): void
    {
        $classes = $this->model->all();
        $this->render('classes/index', ['classes' => $classes]);
    }

    public function create(): void
    {
        //$this->render('subjects/create');
    }
    public function edit(int $id): void
    {
        /*$subject = $this->model->find($id);
        if (!$subject) {
            // Handle invalid ID gracefully
            $_SESSION['warning_message'] = "A tantárgy a megadott azonosítóval: $id nem található.";
            $this->redirect('/subjects');
        }
        $this->render('subjects/edit', ['subject' => $subject]);*/
    }

    public function save(array $data): void
    {
        /*if (empty($data['name'])) {
            $_SESSION['warning_message'] = "A tantárgy neve kötelező mező.";
            $this->redirect('/subjects/create'); // Redirect if input is invalid
        }
        // Use the existing model instance
        $this->model->name = $data['name'];
        $this->model->create();
        $this->redirect('/subjects');*/
    }

    public function update(int $id, array $data): void
    {
        /*$subject = $this->model->find($id);
        if (!$subject || empty($data['name'])) {
            // Handle invalid ID or data
            $this->redirect('/subjects');
        }
        $subject->name = $data['name'];
        $subject->update();
        $this->redirect('/subjects');*/
    }

    function show(int $id): void
    {
        /*$subject = $this->model->find($id);
        if (!$subject) {
            $_SESSION['warning_message'] = "A tantárgy a megadott azonosítóval: $id nem található.";
            $this->redirect('/subjects'); // Handle invalid ID
        }
        $this->render('subjects/show', ['subject' => $subject]);*/
    }

    function delete(int $id): void
    {
        /*$subject = $this->model->find($id);
        if ($subject) {
            $result = $subject->delete();
            if ($result) {
                $_SESSION['success_message'] = 'Sikeresen törölve';
            }
        }

        $this->redirect('/subjects'); // Redirect regardless of success*/
    }

}