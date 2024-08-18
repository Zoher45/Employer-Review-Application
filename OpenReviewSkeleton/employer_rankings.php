<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="img/search-heart.svg"/>
</head>
<body>
<div id="page-container" style="min-height: 100vh">
    <?php
    $index = htmlspecialchars($_GET['offset'] ?? 0);
    $companyName = htmlspecialchars($_GET['companyName'] ?? "");
    $filterOption = htmlspecialchars($_GET['filterOption'] ?? "company_name-DESC");
    ?>
    <!--Navigation bar-->
    <?php include "fragments/navbar.php" ?><br>
    <div id="content-wrap" action="employer_rankings.php">
        <?php include "get_ranking_data.php";?>
        <h1 class="text-center">Employer Rankings</h1> <br>
        <div class="col d-flex justify-content-center">
            <div class="card justify-content-center" style="border: none">
                <div class="card-body" style="">
                    <form id="search-form" action="employer_rankings.php?" method="get">
                        <table>
                            <tbody>
                            <tr>
                                <td style="padding-left: 10px">
                                    <input class="form-control" type="text" placeholder="Company Name"
                                           id="companyName" name="companyName" value="<?php $_GET['companyName'] ?? "" ?>">
                                </td>
                                <input hidden name="offset" value=1>
                                <td style="padding-left: 10px">
                                    <select class="form-select" name="filterOption">
                                        <option value="company_name-DESC" <?php if($filterOption == "company_name-DESC") echo "selected"?>
                                        >Company Name DESC</option>
                                        <option value="company_name-ASC" <?php if($filterOption == "company_name-ASC") echo "selected"?>
                                        >Company Name ASC</option>
                                        <option value="overall_rating-DESC" <?php if($filterOption == "overall_rating-DESC") echo "selected"?>
                                        >Rating DESC</option>
                                        <option value="overall_rating-ASC" <?php if($filterOption == "overall_rating-ASC") echo "selected"?>
                                        >Rating ASC</option>
                                        <option value="reviews_count-DESC" <?php if($filterOption == "reviews_count-DESC") echo "selected"?>
                                        >Total Reviews DESC</option>
                                        <option value="reviews_count-ASC" <?php if($filterOption == "reviews_count-ASC") echo "selected"?>
                                        >Total Reviews ASC</option>
                                    </select>
                                </td>
                                <br>
                                <td style="padding-left: 10px">
                                    <button class="btn btn-primary">Search</button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
        <?php
        $totalNumberOfPages = getNumberOfPages($companyName);
        getPaginatedData($index, $companyName, $filterOption);
        ?>
        <div>
            <?php if($index >= 0 && $index <= $totalNumberOfPages): ?>
                <nav aria-label="Page navigation example mt-5">`
                    <ul class="pagination justify-content-center">
                        <li class="page-item <?php if($index <= 1){ echo 'disabled'; } ?>">
                            <a class="page-link"
                               href="employer_rankings.php?offset=<?php if($index <= 1){ echo $index; } else { echo $index-1; } ?><?= $companyName!= "" ? '&companyName='.$companyName : ""; ?><?= '&filterOption='.$filterOption; ?>">Previous</a>
                        </li>
                        <?php
                        $startPageNumber = ($index <= 5) ? 1 : $index - 5;
                        $endPageNumber = ($index + 5) < $totalNumberOfPages ? $index + 5 : $totalNumberOfPages;
                        for($i = $startPageNumber; $i <= $endPageNumber; $i++ ): ?>
                            <li class="page-item <?php if($index == $i) {echo 'active'; } ?>">
                                <a class="page-link" href="employer_rankings.php?offset=<?= $i; ?><?= $companyName!= "" ? '&companyName='.$companyName : ""; ?><?= '&filterOption='.$filterOption; ?>"> <?= $i; ?> </a>
                            </li>
                        <?php endfor; ?>
                        <li class="page-item <?php if($index >= $totalNumberOfPages) { echo 'disabled'; } ?>">
                            <a class="page-link"
                               href="employer_rankings.php?offset=<?php if($index >= $totalNumberOfPages){ echo $index; } else {echo $index+1; } ?><?= $companyName!= "" ? '&companyName='.$companyName : ""; ?><?= '&filterOption='.$filterOption; ?>">Next</a>
                        </li>
                    </ul>
                </nav>
            <?php endif; ?>
        </div>
    </div><br><br><br>
    <?php include "fragments/footer.php"?>
</div>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const searchValue = urlParams.get('companyName');
    document.getElementById("companyName").value = searchValue;
</script>
</body>
<head>
    <meta charset="UTF-8">
    <title>Employer Rankings</title>
    <link rel="icon" href="img/search-heart.svg" />
    <link rel="stylesheet" href="css/style.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
</head>
</html>
