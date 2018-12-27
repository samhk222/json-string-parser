<?PHP
namespace samhk222;

class Parser
{
    public $hasJSON = false;
    public $hasFaltyJSON = false;
    public $matches = [];

    public function parseString($text)
    {
        $pattern = '/\{(?:[^{}]|(?R))*\}/x ';
        preg_match_all($pattern, $text, $matches);

        if (count($matches[0])>0){
            $this->hasJSON = true;
            foreach ($matches[0] as $key => $value) {
                $decoded = json_decode($value);
                if (json_last_error() !== JSON_ERROR_NONE) {
                    $this->hasFaltyJSON = true;
                } else {
                    $this->matches[] = $decoded;
                }
            }
        }
        return ;
    }
}
