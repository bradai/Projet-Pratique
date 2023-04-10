<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Facture;
use App\Form\FactureCreateType;
use App\Form\FactureType;
use App\Service\FactureManager;
use App\Service\PdfGenerator;
use App\Service\Paginator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/facture")
 */
class FactureController extends AbstractController
{
    private $factureManager;
    private $paginator;
    private $pdfGenerator;

    public function __construct(FactureManager $factureManager, Paginator $paginator, PdfGenerator $pdfGenerator)
    {
        $this->factureManager = $factureManager;
        $this->paginator = $paginator;
        $this->pdfGenerator = $pdfGenerator;
    }

    /**
     * afficher la liste des factures
     * @Route("/", name="app_facture_index", methods={"GET"})
     */
    public function index(Request $request): Response
    {
        $pagination = $this->paginator->paginate(Facture::class, $request);
        return $this->render('facture/index.html.twig', ['pagination' => $pagination]);
    }

    /**
     * cree new facture
     * @Route("/new", name="app_facture_new", methods={"GET", "POST"})
     */
    public function new(Request $request): Response
    {
        $article = new Article();
        $facture = new Facture();
        $form = $this->createForm(FactureCreateType::class, $facture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Calculez le prix total HT en fonction des articles sélectionnés
            $prixTotalHT = 0;
            foreach ($facture->getArticles() as $article) {
                $prixTotalHT += $article->getPrix();
            }
            $facture->setPrixTotalHT($prixTotalHT);
            $this->factureManager->save($facture);
            return $this->redirectToRoute('app_facture_index');
        }

        return $this->render('facture/new.html.twig', [
            'facture' => $facture,
            'articles' => $article,
            'form' => $form->createView(),
        ]);
    }

    /**
     * afficher une facture
     * @Route("/{id}", name="app_facture_show", methods={"GET"})
     */
    public function show(Facture $facture): Response
    {
        return $this->render('facture/show.html.twig', [
            'facture' => $facture,
        ]);
    }

    /**
     * modifier une facture
     * @Route("/{id}/edit", name="app_facture_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Facture $facture): Response
    {
        $form = $this->createForm(FactureType::class, $facture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $prixTotalHT = 0;
            foreach ($facture->getArticles() as $article) {
                $prixTotalHT += $article->getPrix();
            }
            $facture->setPrixTotalHT($prixTotalHT);
            $this->factureManager->save($facture);
            return $this->redirectToRoute('app_facture_index');
        }

        return $this->render('facture/edit.html.twig', [
            'facture' => $facture,
            'form' => $form->createView(),
        ]);
    }

    /**
     * supprimer une facture
     * @Route("/{id}", name="app_facture_delete", methods={"POST"})
     */
    public function delete(Request $request, Facture $facture): Response
    {
        if ($this->isCsrfTokenValid('delete' . $facture->getId(), $request->request->get('_token'))) {
            $this->factureManager->remove($facture);
        }

        return $this->redirectToRoute('app_facture_index', [], Response::
        HTTP_SEE_OTHER);
    }

    /**
     * afficher le pdf facture
     * @Route("/facture/{id}/pdf", name="facture_pdf", methods={"GET"})
     */
    public function downloadPdf(Facture $facture): Response
    {
        $html = $this->renderView('facture/pdf.html.twig', [
            'facture' => $facture,
            'articles' => $facture->getArticles(),
        ]);

        $pdfContent = $this->pdfGenerator->generateFromHtml($html);

        return new Response(
            $pdfContent,
            200,
            [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'attachment; filename="facture-' . $facture->getId() . '.pdf"',
            ]
        );
    }

}