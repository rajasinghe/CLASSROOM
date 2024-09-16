<?php

require_once('./controllers/Controller.php');
require_once('./traits/models/paymentModel.php');
require_once('./traits/models/InstallmentModel.php');
class PaymentController extends Controller
{
    use paymentModel;
    use installmentModel;
    private $response = [];

    private $slipFolder = './public/images/payments';
    private $insallmentffolder = './public/images/installments';
    public function index()
    {
        $this->generateView('./views/pages/payment');
    }

    public function makeInstallment(Request $request)
    {
        $data = $request->getRequestBody();
        if ($data['registeredStudentId'] &&  $data['amount'] && $data['base64slip'] && isset($data['finalInstallment'])) {
            try {
                if (!file_exists($this->insallmentffolder)) {
                    echo "ran";
                    mkdir($this->insallmentffolder,0777,true);
                }
                $decodedImage = base64_decode($data['base64slip']);
                $fileName = $data['registeredStudentId'] . '-' . time() . '.png';
                $filePath = $this->insallmentffolder . '/' . $fileName;

                if (file_put_contents($filePath, $decodedImage)) {
                    if ($this->insertInstallment($data['registeredStudentId'], $data['amount'], $data['base64slip'], $data['finalInstallment'])) {
                        $this->response = ["success" => "saved successfully"];
                    } else {
                        $this->response = ["error" => "error occured in model"];
                    }
                } else {
                    $this->response = ["error" => "error occured while saving the image"];
                }
            } catch (Exception $e) {
                $this->response = ["error" => "unknown error occured->".$e];
            }
        } else {
            $this->response = ["error" => "parameters not set"];
        }


        echo json_encode($this->response);
    }

    public function makePayment(Request $request)
    {
        $data = $request->getRequestBody();
        if (isset($data['interviewId']) && isset($data['paymentType']) && isset($data['amountPaid']) && isset($data['refereceNo'])  && isset($data['base64Image'])) {
            try {
                if (!file_exists($this->slipFolder)) {
                    mkdir($this->slipFolder, 0777, true);
                }

                $decodedImage = base64_decode($data['base64Image']);
                //generate a unique file name
                $fileName = $data['interviewId'] . '.png';
                $filePath = $this->slipFolder . '/' . $fileName;

                if (file_put_contents($filePath, $decodedImage)) {
                    if ($this->initialPayment($data['interviewId'], $filePath, $data['amountPaid'], $data['paymentType'])) {
                        $this->response = ["success" => "data inserted"];
                    } else {
                        $this->response = ["error" => "data insertion failed"];
                    }
                } else {
                    $this->response = ['error' => 'unable to create image'];
                }
            } catch (Exception $e) {
                $this->response = ['error' => $e->getMessage()];
            }
        } else {
            $this->response = ['error' => 'parameters not set'];
        }
        echo json_encode($this->response);
    }

    public function getData(Request $request)
    {
        $result = [];
        $data = $request->getRequestBody();
        if (isset($data['interviewId'])) {
            $result = $this->readPaymentData($data['interviewId']);
        } else {
            $result = ["error" => "interview id not set"];
        }
        echo json_encode($result);
    }

    public function getDataInstallment(Request $request)
    {
        $data = $request->getRequestBody();
        if (isset($data['registeredStudentId'])) {
            $result = $this->readData($data['registeredStudentId']);
            $this->response = $result[0];
        } else {
            $this->response = ["error" => "student id is not set."];
        }
        echo json_encode($this->response);
    }
}
