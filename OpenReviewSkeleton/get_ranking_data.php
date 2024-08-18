<?php
//https://stackoverflow.com/questions/4116499/php-count-round-thousand-to-a-k-style-count-like-facebook-share-twitter-bu
function thousandsCurrencyFormat($num) {

    if($num>1000) {

        $x = round($num);
        $x_number_format = number_format($x);
        $x_array = explode(',', $x_number_format);
        $x_parts = array('k', 'm', 'b', 't');
        $x_count_parts = count($x_array) - 1;
        $x_display = $x;
        $x_display = $x_array[0] . ((int) $x_array[1][0] !== 0 ? '.' . $x_array[1][0] : '');
        $x_display .= $x_parts[$x_count_parts - 1];

        return $x_display;
    }
    return $num;
}
function openConnection ()
{
    try {
        $open_review_s_db = new PDO("sqlite:validations/open_review_s_sqlite.db");
        $open_review_s_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
    return $open_review_s_db;
}

function getNumberOfPages (string $companyName)
{
    try{
        $db = openConnection();
        return ceil(($db->query("SELECT COUNT(*) FROM reviewedEmployer_S
                                                WHERE company_name LIKE '%".$companyName."%'")->fetch()[0]) / 5);
    } catch (Exception $e) {
        die($e->getMessage());
    }
}

function getPaginatedData (int $index, string $companyName, string $filterOption)
{
    try {
        $filterBy = explode("-", $filterOption)[0] ?? "company_name";
        $filterOrder = explode("-", $filterOption)[1] ?? "DESC";

        $open_review_s_db = openConnection();
        $offset = $index < 1 ? 0 : ($index - 1) * 5;

        $res = $open_review_s_db->query("SELECT * FROM reviewedEmployer_S
                                                WHERE company_name LIKE '%".$companyName."%'
                                                ORDER BY ".$filterBy." ".$filterOrder." limit 5 offset ".$offset);

        $hasData = false;
        while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
            $hasData = true;
            echo '
            <div class="col d-flex justify-content-center">
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
                                                <div class="d-inline-block "> <a href="' . $row['company_url'] . '"><h6> ' . $row['company_url'] . ' </h6></div></a>
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
                    </div>
                        <p class="card-text">' . thousandsCurrencyFormat($row['reviews_count']) . ' Review(s)</p>
                        <p>
                            <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample' . $row['employer_id'] . '" aria-expanded="false" aria-controls="collapseExample">
                                Detailed Summary
                            </button>
                           
                            
                            <a class="btn btn-secondary" type="button" href="individual_employer_reviews.php?company_id='.$row['employer_id'].'">
                                View Reviews
                            </a>
                        </p>
                        <div class="collapse" id="collapseExample' . $row['employer_id'] . '">
                            <div class="card card-body">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-lg">
                                            ' . 100 * $row['business_outlook_rating'] . '% Positive Business Outlook
                                        </div>
                                        <div class="col-lg">
                                            ' . 100 * $row['ceo_rating'] . '% Approve of CEO
                                        </div>
                                        <div class="col-lg">
                                            ' . 100 * $row['recommend_to_friend_rating'] . '% Recommend To A Friend
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
            </div><br>
        ';
        }
        if (!$hasData) {
            echo "<hr/><h1 style='text-align: center'>NO RECORDS FOUND</h1>";
        }
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}
?>