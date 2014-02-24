<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */

    }

    public function indexAction(){
        // Создаём объект нашей модели
        $movies = new Application_Model_DbTable_Movies();

        // Применяем метод fetchAll для выборки всех записей из таблицы,
        // и передаём их в view
        $this->view->movies = $movies->fetchAll();

    }

    public function addAction(){
        // Создаём форму
        $form = new Application_Form_Movie();

        // Указываем текст для submit
        $form->submit->setLabel('Add');

        // Передаём форму в view
        $this->view->form = $form;

        // Если к нам идёт Post запрос
        if ($this->getRequest()->isPost()) {

            // Принимаем его
            $formData = $this->getRequest()->getPost();

            // Если форма заполнена верно
            if ($form->isValid($formData)) {

                // Извлекаем режиссёра
                $director = $form->getValue('director');

                // Извлекаем название фильма
                $title = $form->getValue('title');

                // Создаём объект модели
                $movies = new Application_Model_DbTable_Movies();

                // Вызываем метод модели addMovie для вставки новой записи
                $movies->addMovie($director, $title);

                // Используем библиотечный helper для редиректа на action = index
                $this->_helper->redirector('index');
            } else {
            // Если форма заполнена неверно,
            // используем метод populate для заполнения всех полей
            // той информацией, которую ввёл пользователь
            $form->populate($formData);
            }
        }
    }

    public function editAction()
    {
        // action body
    }

    public function deleteAction()
    {
        // action body
    }


}







