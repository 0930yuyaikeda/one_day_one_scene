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
use App\Entity\Scripts;
use App\Entity\Scene;
use App\Entity\SceneEntryCharacters;

// Repository
use App\Repository\AdminsRepository;
use App\Repository\GuestsRepository;
use App\Repository\DecksRepository;
use App\Repository\QuestionsRepository;
use App\Repository\ChoicesRepository;
use App\Repository\GuestPointsRepository;
use App\Repository\ChoicePointsRepository;
use App\Repository\CharactersRepository;
use App\Repository\ScriptsRepository;
use App\Repository\ScenesRepository;
use App\Repository\SceneEntryCharactersRepository;

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
    //    return $this->render('checkBeforePerformance.html.twig',[]);
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
        $allChoice = [];
        $choiceIds = [];

        // 選択肢を取得する
        foreach($questions as $question){

            // 選択肢を抽出
            $choices = $choicesRepository->findBy([
                'question_id' => $question->getQuestionId(),
                'valid_flag' => true,
            ]);

            // 選択肢を格納
            $question->setChoices($choices);

            // すべての選択肢IDを取得する。
            foreach($choices as $choice){
                $allChoice[] = $choice;
                $choiceIds[] = $choice->getChoiceId();
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
            $answer1 = $workAnswers->getQuestion1();
            $answer2 = $workAnswers->getQuestion2();
            $answer3 = $workAnswers->getQuestion3();
            $answer4 = $workAnswers->getQuestion4();
            $answer5 = $workAnswers->getQuestion5();
            $answer6 = $workAnswers->getQuestion6();
            $answer7 = $workAnswers->getQuestion7();
            $answer8 = $workAnswers->getQuestion8();
            $answer9 = $workAnswers->getQuestion9();
            $answer10 = $workAnswers->getQuestion10();
            $answer11 = $workAnswers->getQuestion11();
            $answer12 = $workAnswers->getQuestion12();
            $answer13 = $workAnswers->getQuestion13();
            $answer14 = $workAnswers->getQuestion14();
            $answer15 = $workAnswers->getQuestion15();

            // 選択肢ごとのポイント数を取得する
            $choicePoints = $choicePointsRepository->findBy([
                'choice_id' => $choiceIds,
                'valid_flag' => true,
            ]);

            // ゲストのguestPointsを作成
            $guestPoints = [];
            $characters = $charactersRepository->findBy([ 
                'character_gender_code'  => $guest->getGuestGenderCode(),
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

            // 選択肢を分析して、キャラクターを分析する。
            // Answer 1
            $guestPoints = $this->characterPointAddition( $answer1, $choicePoints, $guestPoints);

            // Answer 2
            $guestPoints = $this->characterPointAddition( $answer2, $choicePoints, $guestPoints);

            // Answer 3
            $guestPoints = $this->characterPointAddition( $answer3, $choicePoints, $guestPoints);

            // Answer 4
            $guestPoints = $this->characterPointAddition( $answer4, $choicePoints, $guestPoints);

            // Answer 5
            $guestPoints = $this->characterPointAddition( $answer5, $choicePoints, $guestPoints);

            // Answer 6
            $guestPoints = $this->characterPointAddition( $answer6, $choicePoints, $guestPoints);

            // Answer 7
            $guestPoints = $this->characterPointAddition( $answer7, $choicePoints, $guestPoints);

            // Answer 8
            $guestPoints = $this->characterPointAddition( $answer8, $choicePoints, $guestPoints);

            // Answer 9
            $guestPoints = $this->characterPointAddition( $answer9, $choicePoints, $guestPoints);

            // Answer 10
            $guestPoints = $this->characterPointAddition( $answer10, $choicePoints, $guestPoints);

            // Answer 11
            $guestPoints = $this->characterPointAddition( $answer11, $choicePoints, $guestPoints);

            // Answer 12
            $guestPoints = $this->characterPointAddition( $answer12, $choicePoints, $guestPoints);

            // Answer 13
            $guestPoints = $this->characterPointAddition( $answer13, $choicePoints, $guestPoints);

            // Answer 14
            $guestPoints = $this->characterPointAddition( $answer14, $choicePoints, $guestPoints);

            // Answer 15
            $guestPoints = $this->characterPointAddition( $answer15, $choicePoints, $guestPoints);

            // ポイント振り完了

            // どのポイントが一番高いかを判別する。
            $highestPoint = null;

            // $guestPointsをループさせながら、一番高いポイントを調査。
            foreach ( $guestPoints as $guestPoint ) {

                // 最初の1週目は比較対象がいないので、最初の$guestPointを格納
                if ( $highestPoint === null ) {
                    $highestPoint = $guestPoint->getGestPoint();
                } else {

                    // 現在の最も高いポイントと比較
                    if ( $guestPoint->getGestPoint() >= $highestPoint ) {

                        // より高い値をhighestGuestPointに格納
                        $highestPoint = $guestPoint->getGestPoint();
                    }
                }
            }

            // 同じポイントで入っている可能性があるので配列で宣言
            $highestGuestPoints = [];

            // 一番高い$highestPointのポイントを$guestPointsを判別。
            // $guestPointsをループさせながら、一番高いポイントを調査
            foreach ( $guestPoints as $guestPoint ) {

                // $highestPointのポイントと一致するものを格納
                if ( $highestPoint === $guestPoint->getGestPoint() ) {

                    // 格納処理
                    $highestGuestPoints[] = $guestPoint;
                }
            }

            // 一番高い選ばれたキャラクターを宣言しておく。
            $selectedCharacter = null;

            // $highestGuestPointsの配列の要素数を調査して複数ある場合は優先順位で決める。
            if ( count($highestGuestPoints) >= 1 ) {

                // 複数の場合の処理
                // ポイントの高いキャラクターを格納する配列を宣言。
                $highestCharacters = [];

                // $highestGuestPointsをループさせながら、キャラクターを格納
                foreach ($highestGuestPoints as $highestGuestPoint ) {

                    // ダブルループ（何このコメント？）
                    foreach ( $characters as $character ) {

                        // キャラクターIDを比較して一致を探す。
                        if ( $highestGuestPoint->getCharacterId() === $character->getCharacterId() ) {

                            // 最もポイントの高いキャラクターを格納
                            $highestCharacters[] = $character;
                        }
                    }
                }

                // 優先順位を確認して最も優先順位の高いキャラクターを判別する。
                foreach ($highestCharacters as $highestCharacter ) {

                    // 最初の1週目は比較対象がいないので、最初の$guestPointを格納
                    if ( $selectedCharacter === null ) {
                        $selectedCharacter = $highestCharacter;
                    } else {

                        // 現在の最も優先順位が最も小さいキャラクターと比較。
                        if ( $selectedCharacter->getPriorityNumber() > $highestCharacter->getPriorityNumber() ) {

                            // より高い値をhighestGuestPointに格納
                            $selectedCharacter = $highestCharacter;
                        }
                    }
                }
            } else {
                // $highestGuestPointsに１つしか要素はないので、解体して、キャラクターIDを取得する。
                $highestPointCharacterId = reset($highestGuestPoints)->getCharacterId();

                foreach ( $characters as $character ) {
                    if ( $highestPointCharacterId === $character->getCharacterId() ) {
                        $selectedCharacter = $character;
                    }
                }
            }

            // キャラクター選択完了

            // キャラクターIDをGuestに登録。
            $guest->setCharacterId( $selectedCharacter->getCharacterId() );

            // DBを更新
            $guestsRepository->save($guest, true);

            // キャラクター画面へ。
            return $this->redirectToRoute('result');
        }

        return $this->render('question.html.twig',[
            'form' => $form->createView(),
            'questionJson' => $this->json($questions,)->getContent(),
        ]);
    }

    public function result( Request $request, Session $session, GuestsRepository $guestsRepository, CharactersRepository $charactersRepository, ScriptsRepository $scriptsRepository) {

        // ゲストIDを取得
        $guestId = $session->get('guest_id');

        // ゲストを取得
        $guest = $guestsRepository->findOneBy([
            'guest_id' => $guestId,
            'valid_flag' => true,
        ]);

        // ゲストの選んだキャラクターを取得
        $character = $charactersRepository->findOneBy([
            'character_id' => $guest->getCharacterId(),
            'valid_flag' => true,
        ]);

        // ゲストの選んだキャラクターの戯曲を取得
        $script = $scriptsRepository->findOneBy([
            'script_id' => $character->getScriptId(),
            'valid_flag' => true,
        ]);

        return $this->render('result.html.twig',[
            'guest' => $guest,
            'character' => $character,
            'script' => $script,
        ]);
    }

    public function chooseScene(
        Request $request,
        Session $session,
        GuestsRepository $guestsRepository,
        CharactersRepository $charactersRepository,
        ScriptsRepository $scriptsRepository,
        ScenesRepository $scenesRepository,
        SceneEntryCharactersRepository $sceneEntryCharactersRepository,
    ) {

        // ゲストIDを取得
        $guestId = $session->get('guest_id');

        // ゲストを取得
        $guest = $guestsRepository->findOneBy([
            'guest_id' => $guestId,
            'valid_flag' => true,
        ]);

        // ゲストの選んだキャラクターを取得
        $character = $charactersRepository->findOneBy([
            'character_id' => $guest->getCharacterId(),
            'valid_flag' => true,
        ]);

        // ゲストの選んだキャラクターの戯曲を取得
        $script = $scriptsRepository->findOneBy([
            'script_id' => $character->getScriptId(),
            'valid_flag' => true,
        ]);

        // ゲストの選んだキャラクターがメインになっているシーンを抽出
        $sceneEntryCharacters = $sceneEntryCharactersRepository->findBy([
            'character_id' => $character->getCharacterId(),
            'main_character_flag' => true,
            'valid_flag' => true,
        ]);

        // ゲストの選んだキャラクターがメインになっているシーンのID用の変数を宣言
        $sceneIds = [];

        // ゲストの選んだキャラクターがメインになっているシーンのIDを格納
        foreach ( $sceneEntryCharacters as $sceneEntryCharacter ) {
            $sceneIds[] = $sceneEntryCharacter->getSceneId();
        }

        // ゲストの選んだキャラクターがメインになっているシーン抽出
        $scenes = $scenesRepository->findBy([
            'scene_id' => $sceneIds,
            'valid_flag' => true,
        ]);

        return $this->render('chooseScene.html.twig',[
            'character' => $character,
            'scenes' => $scenes,
        ]);
    }

    public function checkBeforePerformance( 
        Request $request,
        Session $session,
        GuestsRepository $guestsRepository,
        CharactersRepository $charactersRepository,
        ScriptsRepository $scriptsRepository,
        ScenesRepository $scenesRepository,
    ) {

        // Guestが選んだシーンIDを取得。
        $selectedSceneId = (int)$request->query->get('sceneId');
        
        // ゲストIDを取得
        $guestId = $session->get('guest_id');

        // ゲストを取得
        $guest = $guestsRepository->findOneBy([
            'guest_id' => $guestId,
            'valid_flag' => true,
        ]);

        // シーンIDをGuestに登録。
        $guest->setSceneId( $selectedSceneId );

        // DBを更新
        $guestsRepository->save($guest, true);

        // ゲストの選んだキャラクターを取得
        $character = $charactersRepository->findOneBy([
            'character_id' => $guest->getCharacterId(),
            'valid_flag' => true,
        ]);

        // ゲストの選んだキャラクターの戯曲を取得
        $script = $scriptsRepository->findOneBy([
            'script_id' => $character->getScriptId(),
            'valid_flag' => true,
        ]);

        // ゲストの選んだキャラクターがメインになっているシーン抽出
        $scene = $scenesRepository->findOneBy([
            'scene_id' => $selectedSceneId,
            'valid_flag' => true,
        ]);

        return $this->render('checkBeforePerformance.html.twig',[
            'character' => $character,
            'script' => $script,
            'scene' => $scene,
        ]);
    }

    public function countdown(
        Request $request,
        Session $session,
        GuestsRepository $guestsRepository,
        CharactersRepository $charactersRepository,
        ScriptsRepository $scriptsRepository,
        ScenesRepository $scenesRepository,
    ) {

        // ゲストIDを取得
        $guestId = $session->get('guest_id');

        // ゲストを取得
        $guest = $guestsRepository->findOneBy([
            'guest_id' => $guestId,
            'valid_flag' => true,
        ]);

        // ゲストの選んだキャラクターを取得
        $character = $charactersRepository->findOneBy([
            'character_id' => $guest->getCharacterId(),
            'valid_flag' => true,
        ]);

        // ゲストの選んだキャラクターの戯曲を取得
        $script = $scriptsRepository->findOneBy([
            'script_id' => $character->getScriptId(),
            'valid_flag' => true,
        ]);

        // ゲストの選んだキャラクターがメインになっているシーン抽出
        $scene = $scenesRepository->findOneBy([
            'scene_id' => $guest->getSceneId(),
            'valid_flag' => true,
        ]);

        return $this->render('countdown.html.twig',[
            'script' => $script,
            'scene' => $scene,
        ]);
    }

    public function performance(
        Request $request,
        Session $session,
        GuestsRepository $guestsRepository,
    ) {
        return $this->render('performance.html.twig',[]);
    }

    public function characterPointAddition( $answer, $choicePoints, $guestPoints) {

        // 選択肢を分析して、キャラクターを分析する。
        $return = $guestPoints;

        // NULLでないことを確認
        if ($answer !==  NULL ) {
            // $choicePointsをループして答えと一致するポイントを検索
            foreach ($choicePoints as $choicePoint) {

                // 答えと一致するポイント
                if ( $answer === $choicePoint->getChoiceId() ) {

                    // $guestPointsループしてキャラクターIDの一致を検索
                    foreach ( $guestPoints as $guestPoint ) {

                        // キャラクターIDの一致
                        if ( $guestPoint->getCharacterId() === $choicePoint->getCharacterId() ) {

                            // 元のポイントを取得
                            $baseGestPoint = $guestPoint->getGestPoint();
                            if ( $baseGestPoint === null ) {
                                // 元のポイントがNULLならばを0を代入
                                $baseGestPoint = 0;
                            }

                            // ポイントを追加
                            $guestPoint->setGestPoint( $baseGestPoint + ($choicePoint->getPoint()) );
                            $return = $guestPoints;
                        }
                    }
                }
            }
        }
        return $return;
    }
}