<?php

use Psr\Http\Message\ServerRequestInterface;
use \JFin\Models\CategoryCost;

$app
	// Listagem de categorias
	->get('/category-costs', function () use ($app) {
	    $view = $app->service('view.renderer');

	    $categories = CategoryCost::all();

	    return $view->render('category-costs/list.html.twig', [
	    	'categories' => $categories
	    ]);
	}, 'category-costs.list')

	// Formulário para criação de categorias
	->get('/category-costs/new', function () use ($app) {
		$view = $app->service('view.renderer');
		return $view->render('category-costs/create.html.twig');
	}, 'category-costs.new')

	// Salva uma nova categoria
	->post('/category-costs/store', function (ServerRequestInterface $request) use ($app) {
		$data = $request->getParsedBody();
		CategoryCost::create($data);

		return $app->route('category-costs.list');
	}, 'category-costs.store')

	// Formulário de edição de categoria
	->get('/category-costs/{id}/edit', function (ServerRequestInterface $request) use ($app) {
		$view = $app->service('view.renderer');

		$id = $request->getAttribute('id');
		$category = CategoryCost::findOrFail($id);

		return $view->render('category-costs/edit.html.twig', [
			'category' => $category
		]);
	}, 'category-costs.edit')

	// Atualiza uma categoria
	->post('/category-costs/{id}/update', function (ServerRequestInterface $request) use ($app) {
		$view = $app->service('view.renderer');

		$id = $request->getAttribute('id');
		$category = CategoryCost::findOrFail($id);

		$data = $request->getParsedBody();
		$category->fill($data);
		$category->save();

		return $app->route('category-costs.list');
	}, 'category-costs.update')

	// Mostra uma categoria
	->get('/category-costs/{id}/show', function (ServerRequestInterface $request) use ($app) {
		$view = $app->service('view.renderer');

		$id = $request->getAttribute('id');
		$category = CategoryCost::findOrFail($id);

		return $view->render('category-costs/show.html.twig', [
			'category' => $category
		]);
	}, 'category-costs.show')

	// Deleta uma categoria
	->get('/category-costs/{id}/delete', function (ServerRequestInterface $request) use ($app) {
		$view = $app->service('view.renderer');

		$id = $request->getAttribute('id');
		$category = CategoryCost::findOrFail($id);
		$category->delete();

		return $app->route('category-costs.list');
	}, 'category-costs.delete');