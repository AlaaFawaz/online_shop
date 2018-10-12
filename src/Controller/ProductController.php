<?php
/**
 * Created by PhpStorm.
 * User: Ala_AbuDheileh
 * Date: 10.10.18
 * Time: 13:26
 */
namespace App\Controller;

use App\Entity\Product;
use phpDocumentor\Reflection\Types\String_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class ProductController extends AbstractController{

    /**
     * @Route("/add", name="addProduct")
     */
    public function addProduct(Request $request){

        $productName = $request->request->get("productName");
        $productDescription =  $request->request->get("productDescription");
        $entityManager = $this->getDoctrine()->getManager();

        $product = new Product();
        $product->setProductName($productName);
        $product->setProductDescription($productDescription);

        $entityManager->persist($product);
        $entityManager->flush();

        return $this->redirectToRoute("products_list");
    }

    /**
     * @Route("/update" ,name="update" )
     */
    public function updateProduct(Request $request){

        $entityManager = $this->getDoctrine()->getManager();
        $product = $entityManager->getRepository(Product::class)->find($request->request->get("id"));
        $product->setProductName($request->request->get("productName"));
        $product->setProductDescription($request->request->get("productDescription"));

        $entityManager->flush();

        return $this->redirectToRoute("products_list");
    }

    /**
     * @Route("/delete/{id}" , name="delete" , requirements={"id"="\d+"})
     */
    public function deleteProduct($id){

        $entityManager = $this->getDoctrine()->getManager();
        $product = $entityManager->getRepository(Product::class)->find($id);

        $entityManager->remove($product);
        $entityManager->flush();

        return $this->redirectToRoute("products_list");
    }

    /**
     * @Route("/", name="products_list")
     */
    public function listProducts(){

        $entityManager = $this->getDoctrine()->getManager();
        $products = $entityManager->getRepository(Product::class)->findAll();

        return $this->render('productsList.html.twig',[
        'products' => $products,
        ]);

    }

    /**
     * @Route("/addingNewProduct" , name="addingNewProduct")
     */
    public function redirectToAddPage(){

        return $this->render('addingProduct.html.twig');
    }

    /**
     * @Route("/editProduct/{id}" , name="editProduct" , requirements={"id"="\d+"})
     */
    public function redirectToEditPage($id){

        $entityManager = $this->getDoctrine()->getManager();
        $product = $entityManager->getRepository(Product::class)->find($id);

        return $this->render("updateProduct.html.twig",["product"=>$product]);
    }
}