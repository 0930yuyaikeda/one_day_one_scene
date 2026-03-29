<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Session\Session;

// Entity
use App\Entity\Admins;
use App\Entity\Guests;
use App\Entity\Choices;
use App\Entity\ChoicePoints;
use App\Entity\GuestPoints;

// Repository
use App\Repository\AdminsRepository;
use App\Repository\GuestsRepository;
use App\Repository\DecksRepository;
use App\Repository\QuestionsRepository;
use App\Repository\ChoicesRepository;
use App\Repository\GuestPointsRepository;
use App\Repository\ChoicePointsRepository;
use App\Repository\CharactersRepository;

// Form
use App\Form\GuestType;
use App\Form\DeckType;
use App\Form\QuestionType;

// FormModel
use App\FormModel\QuestionFormModel;

define('GUEST_TYPE', 1);
define('PERFORMANCE_FLAG', true);
define('SELECTED_DECK', 'selectedDeck');

class OneDayOneSceneController extends AbstractController
{
    /*===========
    
    ===========*/
    public function index(): Response
    {

       return $this->render('index.html.twig',[]);
    //    return $this->render('inputName.html.twig',[]);
    //    return $this->render('chooseDecks.html.twig',[]);
    //    return $this->render('checkDeckAndName.html.twig',[]);
    //    return $this->render('question.html.twig',[]);
    //    return $this->render('result.html.twig',[]);
    //    return $this->render('scriptDescription.html.twig',[]);
    //    return $this->render('chooseScene.html.twig',[]);
    //    return $this->render('countdown.html.twig',[]);
    //    return $this->render('performance.html.twig',[]);
    }

    public function inputName(Request $request, GuestsRepository $guestsRepository, Session $session): Response
    {
       // 新しいGuestを作成する
        $guest = new Guests();

        // 新しいフォームを作成する
        $form = $this->createForm(GuestType::class, $guest);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // フォームからデータを取得。
            $guest = $form->getData();

            // ゲストタイプをセットする
            $guest->setGuestType(GUEST_TYPE);

            // パフォーマンスフラグをセットする。
            $guest->setPerformanceFlag(PERFORMANCE_FLAG);

            // インサート日時をセットする。
            $guest->setCreatedDatetime(new \DateTime());

            // [todo]アドミンidをセットする。
            $guest->setCreatedAdmin(1);

            // 有効フラグをセットする。
            $guest->setValidFlag(1);

            // DBに保存する。
            $guestsRepository->save($guest, true);

            // 登録したユーザーIDをセッションに登録
            $session = new Session();
            $session->remove('guest_id');
            $session->set('guest_id',$guest->getGuestId());

            // デッキ選択に移動。
            return $this->redirectToRoute('choose_decks');
        }

        // 名前と性別の入力画面へ。
        return $this->render('inputName.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    public function chooseDecks(Request $request, Session $session, GuestsRepository $guestsRepository, DecksRepository $decksRepository): Response
    {
        // ゲストIDを取得
        $guestId = $session->get('guest_id');

        // ゲストを取得。
        $guest = $guestsRepository->findOneBy([
            'guest_id' => $guestId,
            'valid_flag' => true,
        ]);

        // デッキを取得。
        $decks = $decksRepository->findBy([
            'play_flag'  => true,
            'valid_flag' => true,
        ]);

        // 新しいフォームを作成する
        $form = $this->createForm(DeckType::class, null, [
            'decks' => $decks,
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // 選択されたデッキを取得。
            $deckArray = $form->getData();
            $deck = $deckArray[SELECTED_DECK];

            // ゲストのDECK_IDをセットする。
            $guest->setDeckId($deck->getDeckId());

            // ゲストIDをDBに保存する。
            $guestsRepository->save($guest, true);

            // 名前とデッキの確認画面へ。
            return $this->redirectToRoute('check_deck_and_name');
        }

        return $this->render('chooseDecks.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    public function checkDeckAndName(Request $request, Session $session, GuestsRepository $guestsRepository, DecksRepository $decksRepository): Response
    {
        // ゲストIDを取得
        $guestId = $session->get('guest_id');

        // ゲストを取得。
        $guest = $guestsRepository->findOneBy([
            'guest_id' => $guestId,
            'valid_flag' => true,
        ]);

        // デッキを取得
        $deck = $decksRepository->findOneBy([
            'deck_id'    => $guest->getDeckId(),
            'valid_flag' => true,
        ]);

        return $this->render('checkDeckAndName.html.twig',[
            'guest'  => $guest,
            'deck' => $deck
        ]);
    }

    public function question(
        Request $request,
        Session $session,
        GuestsRepository $guestsRepository,
        QuestionsRepository $questionsRepository,
        ChoicesRepository $choicesRepository,
        GuestPointsRepository $guestPointsRepository,
        ChoicePointsRepository $choicePointsRepository,
        CharactersRepository $charactersRepository
    ): Response
    {
        // ゲストIDを取得
        $guestId = $session->get('guest_id');

        // ゲストを取得
        $guest = $guestsRepository->findOneBy([
            'guest_id' => $guestId,
            'valid_flag' => true,
        ]);

        // 質問を取得
        $questions = $questionsRepository->findBy([
            'deck_id' => $guest->getDeckId(),
            'valid_flag' => true,
        ]);

        // 選択肢用の配列を宣言
        $choiceIds = [];

        // 選択肢を取得する
        foreach($questions as $question){

            // 選択肢を抽出
            $workChoices = $choicesRepository->findBy([
                'question_id' => $question->getQuestionId(),
                'valid_flag' => true,
            ]);

            // 選択肢を格納
            $question->setChoices($workChoices);

            // すべての選択肢IDを取得する。
            foreach($workChoices as $workChoice){
                $choiceIds[] = $workChoice->getChoiceId();
            }
        }

        // フォームを作成
        $form = $this->createForm(QuestionType::class, new QuestionFormModel());
        $form->handleRequest($request);

        //　結果を見て診断する！
        if ($form->isSubmitted() && $form->isValid()) {

            // 答えを取得。
            $workAnswers = $form->getData();

            // 答えを配列に変換する
            $answers = [];
            $answers[] = $workAnswers->getQuestion1();
            $answers[] = $workAnswers->getQuestion2();
            $answers[] = $workAnswers->getQuestion3();
            $answers[] = $workAnswers->getQuestion4();
            $answers[] = $workAnswers->getQuestion5();
            $answers[] = $workAnswers->getQuestion6();
            $answers[] = $workAnswers->getQuestion7();
            $answers[] = $workAnswers->getQuestion8();
            $answers[] = $workAnswers->getQuestion9();
            $answers[] = $workAnswers->getQuestion10();
            $answers[] = $workAnswers->getQuestion11();
            $answers[] = $workAnswers->getQuestion12();
            $answers[] = $workAnswers->getQuestion13();
            $answers[] = $workAnswers->getQuestion14();
            $answers[] = $workAnswers->getQuestion15();

            // 選択肢ごとのポイント数を取得する
            $choicePoints = $choicePointsRepository->findBy([
                'choice_point_id' => $choiceIds,
                'valid_flag' => true,
            ]);

            // ゲストのguestPointsを作成
            $guestPoints = [];
            $characters = $charactersRepository->findBy([    
                'valid_flag' => true,
            ]);

            // キャラクターの数だけゲストポイントを作成
            foreach ($characters as $character) {
                // ゲストポイント単体を作成
                $guestPoint = new GuestPoints();

                // ゲストポイントにキャラクターIDを格納
                $guestPoint->setCharacterId($character->getCharacterId());

                // ゲストポイントを配列に格納
                $guestPoints[] = $guestPoint;
            }

            dd($guestPoints);




            // 選択肢を分析して、キャラクターを分析する。
            foreach ($answers as $answer) {

                // NULLだったらブレイクする。
                if ( $answer === NULL ) {
                    dd('break');
                    break;
                }
            }




            //
            // dd($choicePoints);
            // dd($questions);
            // dd($guest);
            // dd($answers);
            dd('ikeda');

        }

        return $this->render('question.html.twig',[
            'form' => $form->createView(),
            'questionJson' => $this->json($questions,)->getContent(),
        ]);
    }


}