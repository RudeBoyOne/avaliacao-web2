<?php
namespace Avaliacao\Web\Controller;

use Avaliacao\Web\Common\ResponseAssemblerSuccess;
use Avaliacao\Web\Repository\LogRepository;

class LogController {
    
    private $logRepository;


    public function __construct(LogRepository $logRepository) {
        $this->logRepository = $logRepository;
    }

    public function getAll() {
        $result = $this->logRepository->getAllLog();
        ResponseAssemblerSuccess::response(200, $result);
    }

}
