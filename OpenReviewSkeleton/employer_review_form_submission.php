<?php

include_once "Review.php";

if (isset($_POST['query'],
        $_POST['overallRating'],
        $_POST['jobTitle'],
        $_POST['employmentStatus'],
        $_POST['currentJob'],
        $_POST['yearsEmployed'],
        $_POST['submit']) &&
    $_POST['overallRating'] > 0 && $_POST['overallRating'] < 6 &&
    (strlen($_POST['jobTitle']) > 0 && strlen($_POST['jobTitle']) < 255) &&
    in_array($_POST['employmentStatus'], array("REGULAR", "PART_TIME", "CONTRACT", "FREELANCE", "INTERN")) &&
    ($_POST['currentJob'] == 0 || $_POST['currentJob'] == 1) &&
    $_POST['yearsEmployed'] != "" &&
    $_POST['yearsEmployed'] > -1) {

//    Required Parameters
    $employer = htmlspecialchars($_POST['query']);
    $employerID = (int) htmlspecialchars($_POST['employerId']);
    $overallRating = htmlspecialchars($_POST['overallRating']);
    $jobTitle = htmlspecialchars($_POST['jobTitle']);
    $employmentStatus = htmlspecialchars($_POST['employmentStatus']);
    $currentJob = htmlspecialchars($_POST['currentJob']);
    $jobEndingYear = isset($_POST['jobEndingYear']) ? htmlspecialchars($_POST['jobEndingYear']) : null;
    $yearsEmployed = htmlspecialchars($_POST['yearsEmployed']);

//    Optional Parameters
    $summary = isset($_POST['summary']) && strlen($_POST['summary']) > 0 && strlen($_POST['summary']) < 255 ?
        htmlspecialchars($_POST['summary']) : null;
    $advice = isset($_POST['advice']) && strlen($_POST['advice']) > 0 && strlen($_POST['advice']) < 255 ?
        htmlspecialchars($_POST['advice']) : null;
    $pros = isset($_POST['pros']) && strlen($_POST['pros']) > 0 && strlen($_POST['pros']) < 255 ?
        htmlspecialchars($_POST['pros']) : null;
    $cons = isset($_POST['cons']) && strlen($_POST['cons']) > 0 && strlen($_POST['cons']) < 255 ?
        htmlspecialchars($_POST['cons']) : null;

    $businessOutlook = isset($_POST['businessOutlook']) && in_array($_POST['businessOutlook'], array("Positive", "Neutral", "Negative")) ?
        htmlspecialchars($_POST['businessOutlook']) : null;
    $recommendToFriend = isset($_POST['recommendToFriend']) && in_array($_POST['recommendToFriend'], array("POSITIVE", "NEGATIVE")) ?
        htmlspecialchars($_POST['recommendToFriend']) : null;
    $ceoRating = isset($_POST['ceoRating']) && in_array($_POST['ceoRating'], array("APPROVE", "NO_OPINION", "DISAPPROVE")) ?
        htmlspecialchars($_POST['ceoRating']) : null;
    $careerOpportunities = isset($_POST['careerOpportunities']) && $_POST['careerOpportunities'] > 0 && $_POST['careerOpportunities'] < 6 ?
        htmlspecialchars($_POST['careerOpportunities']) : 0;
    $compensation = isset($_POST['compensation']) && $_POST['compensation'] > 0 && $_POST['compensation'] < 6 ?
        htmlspecialchars($_POST['compensation']) : 0;
    $culture = isset($_POST['culture']) && $_POST['culture'] > 0 && $_POST['culture'] < 6 ?
        htmlspecialchars($_POST['culture']) : 0;
    $diversity = isset($_POST['diversity']) && $_POST['diversity'] > 0 && $_POST['diversity'] < 6 ?
        htmlspecialchars($_POST['diversity']) : 0;
    $seniorLeadership = isset($_POST['seniorLeadership']) && $_POST['seniorLeadership'] > 0 && $_POST['seniorLeadership'] < 6 ?
        htmlspecialchars($_POST['seniorLeadership']) : 0;
    $workLifeBalance = isset($_POST['workLifeBalance']) && $_POST['workLifeBalance'] > 0 && $_POST['workLifeBalance'] < 6 ?
        htmlspecialchars($_POST['workLifeBalance']) : 0;

    $review = new Review($employerID, $overallRating, $jobTitle, $employmentStatus,
        $currentJob, $jobEndingYear, $yearsEmployed,
        $summary, $advice, $pros, $cons,
        $businessOutlook, $recommendToFriend, $ceoRating,
        $careerOpportunities, $compensation, $culture,
        $diversity, $seniorLeadership, $workLifeBalance);

    insertReview($review);
} else {
    echo $_POST['query'];
    $error = "Please fill all the required fields";
    header("Location: review_employer.php?message=".$error);
}




function insertReview($review){
    try {
        $open_review_s_db = new PDO("sqlite:validations/open_review_s_sqlite.db");
        $open_review_s_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die($e->getMessage());
    }

    $query = "INSERT INTO employerReview_S (employerId, reviewDateTime,
                              advice, cons, employmentStatus, isCurrentJob,
                              jobEndingYear, jobTitle, lengthOfEmployment, pros,
                              ratingBusinessOutlook,
                              ratingCareerOpportunities,
                              ratingCeo,
                              ratingCompensationAndBenefits,
                              ratingCultureAndValues,
                              ratingDiversityAndInclusion,
                              ratingOverall,
                              ratingRecommendToFriend,
                              ratingSeniorLeadership,
                              ratingWorkLifeBalance,
                              summary) 
                VALUES (
                        :employerID, datetime(),
                        :advice,:cons, :employmentStatus, :currentJob,
                        :jobEndingYear,:jobTitle, :yearsEmployed, :pros,
                        :businessOutlook,
                        :careerOpportunities,
                        :ceoRating,
                        :compensation,
                        :culture,
                        :diversity,
                        :overallRating,
                        :recommendToFriend,
                        :seniorLeadership,:workLifeBalance, :summary);";

    try {
        $stmt = $open_review_s_db->prepare($query);
        // Required Params
        $stmt->bindParam(':employerID', $review->employerID);
        $stmt->bindParam(':overallRating', $review->overallRating, PDO::PARAM_INT);
        $stmt->bindParam(':jobTitle', $review->jobTitle);
        $stmt->bindParam(':employmentStatus', $review->employmentStatus);
        $stmt->bindParam(':currentJob', $review->currentJob, PDO::PARAM_INT);
        $stmt->bindParam(':jobEndingYear', $review->jobEndingYear, PDO::PARAM_INT);
        $stmt->bindParam(':yearsEmployed', $review->yearsEmployed, PDO::PARAM_INT);
        // Optional Params
        $stmt->bindParam(':summary', $review->summary);
        $stmt->bindParam(':advice', $review->advice);
        $stmt->bindParam(':cons', $review->cons);
        $stmt->bindParam(':pros', $review->pros);
        $stmt->bindParam(':businessOutlook', $review->businessOutlook);
        $stmt->bindParam(':careerOpportunities', $review->careerOpportunities, PDO::PARAM_INT);
        $stmt->bindParam(':ceoRating', $review->ceoRating);
        $stmt->bindParam(':compensation', $review->compensation, PDO::PARAM_INT);
        $stmt->bindParam(':culture', $review->culture, PDO::PARAM_INT);
        $stmt->bindParam(':diversity', $review->diversity, PDO::PARAM_INT);
        $stmt->bindParam(':recommendToFriend', $review->recommendToFriend);
        $stmt->bindParam(':seniorLeadership', $review->seniorLeadership, PDO::PARAM_INT);
        $stmt->bindParam(':workLifeBalance', $review->workLifeBalance, PDO::PARAM_INT);

        $stmt->execute();
        header("Location: individual_employer_reviews.php?company_id=".$review->employerID."&reviewed=successful");
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}








