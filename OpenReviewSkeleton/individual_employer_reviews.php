<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Individual Reviews</title>
    <link rel="icon" href="img/search-heart.svg" />
    <link rel="stylesheet" href="css/style.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <!-- core CSS of SnackbarJS, find it in /dist -->
    <link href="js/snackbarjs/snackbar/dist/snackbar.min.css" rel="stylesheet">
    <!-- the default theme of SnackbarJS, find it in /themes-css -->
    <link href="js/snackbarjs/snackbar/themes-css/material.css" rel="stylesheet">
</head>

<body>
    <!--Navigation bar-->
    <?php include "fragments/navbar.php" ?><br><br>
    <span data-toggle=snackbar
          data-style="toast"
    style="display: none"></span>

        <?php include "get_ranking_data.php";?>
        <?php
        $company_id = $_GET['company_id'];
        function checkRating($num): string
        {
            if($num == "APPROVE" || $num == "POSITIVE") {
                return '<img src="img/tick.svg" />';
            }
            if($num == "NEGATIVE" || $num == "DISAPPROVE") {
                return '<img src="img/negative.svg" />';
            }
            return '<img src="img/dash.svg" />';
        }

        function checkStar($num): string
        {
            if( $num > 0) {
                return $num . ' <img src="img/star.svg" />';
            }
            return '<img src="img/dash.svg" />';
        }

        function jobTitleFormat($isCurrentJob, $title): string
        {
            $dash = '';
            if(strlen($title) > 0) {
                $dash = ' -';
            }
            if( $isCurrentJob == 1) {
                return $title . $dash . ' Current Employee';
            }
            return $title . $dash . ' Former Employee';
        }

        try {
            $open_review_s_db = new PDO("sqlite:validations/open_review_s_sqlite.db");
            $open_review_s_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        try {
            $res = $open_review_s_db->query("SELECT * FROM reviewedEmployer_S WHERE employer_id=".$company_id);
            while($row = $res->fetch(PDO::FETCH_ASSOC)) {

                echo '   <div class="col d-flex justify-content-center">
                                    <div class="card justify-content-center" style="width: 60%;">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between">
                                                <div class="container">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <h2> ' . $row['company_name'] . '</h2>
                                                        </div>
                                                        
                                                        <div class="col">
                                                            <div class="d-flex flex-column">
                                                                <div class="d-inline-block">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pin-map-fill" viewBox="0 0 16 16">
                                                                        <path fill-rule="evenodd" d="M3.1 11.2a.5.5 0 0 1 .4-.2H6a.5.5 0 0 1 0 1H3.75L1.5 15h13l-2.25-3H10a.5.5 0 0 1 0-1h2.5a.5.5 0 0 1 .4.2l3 4a.5.5 0 0 1-.4.8H.5a.5.5 0 0 1-.4-.8l3-4z"/>
                                                                        <path fill-rule="evenodd" d="M4 4a4 4 0 1 1 4.5 3.969V13.5a.5.5 0 0 1-1 0V7.97A4 4 0 0 1 4 3.999z"/>
                                                                    </svg>
                                                                    <div class="d-inline-block "> <h6>' . $row['company_hq'] . '</h6></div>
                                                                </div>
                            
                                                                <div class="d-inline-block">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-globe" viewBox="0 0 16 16">
                                                                        <path d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm7.5-6.923c-.67.204-1.335.82-1.887 1.855A7.97 7.97 0 0 0 5.145 4H7.5V1.077zM4.09 4a9.267 9.267 0 0 1 .64-1.539 6.7 6.7 0 0 1 .597-.933A7.025 7.025 0 0 0 2.255 4H4.09zm-.582 3.5c.03-.877.138-1.718.312-2.5H1.674a6.958 6.958 0 0 0-.656 2.5h2.49zM4.847 5a12.5 12.5 0 0 0-.338 2.5H7.5V5H4.847zM8.5 5v2.5h2.99a12.495 12.495 0 0 0-.337-2.5H8.5zM4.51 8.5a12.5 12.5 0 0 0 .337 2.5H7.5V8.5H4.51zm3.99 0V11h2.653c.187-.765.306-1.608.338-2.5H8.5zM5.145 12c.138.386.295.744.468 1.068.552 1.035 1.218 1.65 1.887 1.855V12H5.145zm.182 2.472a6.696 6.696 0 0 1-.597-.933A9.268 9.268 0 0 1 4.09 12H2.255a7.024 7.024 0 0 0 3.072 2.472zM3.82 11a13.652 13.652 0 0 1-.312-2.5h-2.49c.062.89.291 1.733.656 2.5H3.82zm6.853 3.472A7.024 7.024 0 0 0 13.745 12H11.91a9.27 9.27 0 0 1-.64 1.539 6.688 6.688 0 0 1-.597.933zM8.5 12v2.923c.67-.204 1.335-.82 1.887-1.855.173-.324.33-.682.468-1.068H8.5zm3.68-1h2.146c.365-.767.594-1.61.656-2.5h-2.49a13.65 13.65 0 0 1-.312 2.5zm2.802-3.5a6.959 6.959 0 0 0-.656-2.5H12.18c.174.782.282 1.623.312 2.5h2.49zM11.27 2.461c.247.464.462.98.64 1.539h1.835a7.024 7.024 0 0 0-3.072-2.472c.218.284.418.598.597.933zM10.855 4a7.966 7.966 0 0 0-.468-1.068C9.835 1.897 9.17 1.282 8.5 1.077V4h2.355z"/>
                                                                    </svg>
                                                                    <div class="d-inline-block "> <a href="'.$row['company_url'].'"><h6> ' . $row['company_url'] . ' </h6></div></a>
                                                                </div>
                                                        </div>
                            
                                                    </div>
                                              
                                                        <div class="col-3">
                                                            <div class="d-inline-block"> <h3>' . $row['overall_rating'] . '</h3></div>
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 20 20">
                                                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                            </svg>
                                                        </div>
                                                </div>
                                            </div>
                                        </div><br>
                                          
                                            <div >
                                                <div class="card card-body">
                                                    <div class="container">
                                                        <div class="row">
                                                            <div class="col-lg">
                                                                '. 100 * $row['business_outlook_rating'] . '% Positive Business Outlook
                                                            </div>
                                                            <div class="col-lg">
                                                                '. 100 * $row['ceo_rating'] . '% Approve of CEO
                                                            </div>
                                                            <div class="col-lg">
                                                                '. 100 * $row['recommend_to_friend_rating'] . '% Recommend To A Friend
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="d-flex justify-content-between">
                                                        <div class="d-flex flex-column">
                                                            <table class="table table-borderless">
                                                                <tbody>
                                                                    <tr>
                                                                        <td>Overall:  </td>
                                                                        <td>' . $row['overall_rating'] . '
                                                                            <img src="img/star.svg">
                                                                        </td>
                            
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Diversity & Inclusion: </td>
                                                                        <td>
                                                                            ' . $row['diversity_and_inclusion_rating'] . '
                                                                            <img src="img/star.svg">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Work/Life Balance: </td>
                                                                        <td>
                                                                            ' . $row['work_life_balance_rating'] . '
                                                                            <img src="img/star.svg">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Culture & Values:</td>
                                                                        <td>
                                                                            ' . $row['culture_and_values_rating'] . '
                                                                           <img src="img/star.svg">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Career Opportunities:</td>
                                                                        <td>
                                                                            ' . $row['career_opportunities_rating'] . '
                                                                           <img src="img/star.svg">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Compensation and Benefits:</td>
                                                                        <td>
                                                                            ' . $row['compensation_and_benefits_rating'] . '
                                                                            <img src="img/star.svg">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Senior Leadership:</td>
                                                                        <td>
                                                                            ' . $row['senior_leadership_rating'] . '
                                                                            <img src="img/star.svg">
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><br><br>
                                <h4 class="text-center">Top 10 Recent Reviews</h4> <br><br>
                                ';
                $res = $open_review_s_db->query("SELECT * FROM employerReview_S WHERE employerId=".$company_id." ORDER BY reviewDateTime DESC LIMIT 10");
                while($row = $res->fetch(PDO::FETCH_ASSOC)) {
                   echo '    <div class="col d-flex justify-content-center">
                                    <div class="card justify-content-center" style="width: 60%;">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between">
                                                <div class="container">
                                                    <div class="row">
                                                        <div class="col-9">
                                                                <div class="d-inline-block"> <h3> Overall Rating: ' . $row['ratingOverall'] . '</h3></div>
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 20 20">
                                                                    <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                </svg>
                                                            </div>
                                                        <div class="col-3">
                                                            <h6> Review Date: ' .date_format(date_create($row['reviewDateTime']),"d/m/Y") . '</h6>
                                                        </div>
                                                    </div><br>
                                                     <div class="col-12">
                                                            <h5> ' . jobTitleFormat($row['isCurrentJob'], $row['jobTitle']) . ' </h5>                                        
                                                     </div>
                                                     
                                                     <div class="col-12 pt-1">
                                                            <h6> Summary: </h6>
                                                            <p class="border col-12 p-2 overflow-auto" style="height: 100px">
                                                                ' . $row['summary'] . '
                                                            </p>
                                                     </div>
                                                     <div class="row pt-1">
                                                            <div class="col-6">
                                                                <h6> Pros: </h6>
                                                                 <div class="border p-2 overflow-auto" style="height: 150px">
                                                                    ' . $row['pros'] . '
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <h6> Cons: </h6>
                                                                 <div class="border p-2 overflow-auto" style="height: 150px">
                                                                    ' . $row['cons'] . '
                                                                </div>
                                                            </div>
                                                     </div>
                                                     <div class="col-12 pt-3">
                                                            <h6> Advice: </h6>
                                                            <p class="border col-12 p-2 overflow-auto" style="height: 100px">
                                                                ' . $row['advice'] . '
                                                            </p>
                                                     </div>
                                                   
                                                </div>
                                            </div>
                                        </div>
                                            <p class="ps-3">
                                                <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample'.$row['reviewId'].'" aria-expanded="false" aria-controls="collapseExample">
                                                    Detailed Summary
                                                </button>
                                            </p>
                                            <div class="collapse" id="collapseExample'.$row['reviewId'].'">
                                                <div class="card card-body">
                                                    <div class="container">
                                                        <div class="row">
                                                            <div class="col-lg">
                                                                '. checkRating($row['ratingBusinessOutlook'])  . ' Positive Business Outlook
                                                            </div>
                                                            <div class="col-lg">
                                                                '. checkRating($row['ratingCeo']) . ' Approve of CEO
                                                            </div>
                                                            <div class="col-lg">
                                                                '. checkRating($row['ratingRecommendToFriend']) . ' Recommend To A Friend
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="d-flex justify-content-between">
                                                        <div class="d-flex flex-column">
                                                            <table class="table table-borderless">
                                                                <tbody>
                                                                    <tr>
                                                                        <td>Overall:  </td>
                                                                        <td>' . checkStar($row['ratingOverall'])  . '
                                                                           
                                                                        </td>
                            
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Diversity & Inclusion: </td>
                                                                        <td>
                                                                            ' . checkStar($row['ratingDiversityAndInclusion']) . '
                                                                           
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Work/Life Balance: </td>
                                                                        <td>
                                                                            ' . checkStar($row['ratingWorkLifeBalance']) . '
                                                                           
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Culture & Values:</td>
                                                                        <td>
                                                                            ' . checkStar($row['ratingCultureAndValues']) . '
                                                                            
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Career Opportunities:</td>
                                                                        <td>
                                                                            ' . checkStar($row['ratingCareerOpportunities']) . '
                                                                           
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Compensation and Benefits:</td>
                                                                        <td>
                                                                            ' . checkStar($row['ratingCompensationAndBenefits']) . '
                                                                            
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Senior Leadership:</td>
                                                                        <td>
                                                                            ' . checkStar($row['ratingSeniorLeadership']) . '
                                                                       
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><br>';
                }
            }
        } catch (PDOException $e) {
            die($e->getMessage());
        }
        ?>
    <br><br><br>
    <footer class="bg-dark text-center text-lg-start" >
        <!-- Copyright -->
        <div class="text-center p-3 text-light">
            © 2022 Copyright:
            <a class="text-light" href="index.php">rater.com</a>
        </div>
        <!-- Copyright -->
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

    <script src="js/snackbarjs/snackbar/src/snackbar.js"></script>
    <?php
    $reviewed = isset($_GET['reviewed']);
    if($reviewed && $_GET['reviewed'] == "successful"): ?>
        <script>
            $(function() {
                $.snackbar({content: "Thank you for Reviewing our company.", timeout: 5000});
            });
        </script>
    <?php endif; ?>
</body>
