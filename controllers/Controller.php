<?php
    require_once('./traits/terminal.php');

    use Sabberworm\CSS\Parser;
    class Controller{
        use Terminal;

        public function generateView($path,array $data = []){

            foreach ($data as $key => $value) {
                ${$key} = $value;
            }

            require($path);
        }

        private function applyStylesToHTML($htmlContent, $cssContent) {
            // Parse CSS
            $cssParser = new Parser($cssContent);
            $cssDocument = $cssParser->parse();
        
            //var_dump($cssDocument);
            // Extract CSS rules and apply them to HTML elements
            foreach ($cssDocument->getAllRuleSets() as $ruleSet) {
                // Get selectors and properties from the rule set
                $selectors = $ruleSet->getSelectors();
                $properties = $ruleSet->getRules();
                //var_dump($selectors);
                /*echo "<br>";
                var_dump($properties); */
        
                // Construct CSS selector string
                $selectorString = implode(',', $selectors);
                //echo "<br>";
                $combinedSelectors = explode(' ',$selectorString);
                var_dump($combinedSelectors);
        
                // Find matching elements in HTML content
                preg_match_all('/<(' . $selectorString . ').*?>/si', $htmlContent, $matches);
        
                //var_dump($matches);
                // Apply styles to matching HTML elements
                foreach ($matches[0] as $match) {
                    // Apply CSS properties to HTML element
                    $htmlContent = str_replace($match, $this->applyStyles($match, $properties), $htmlContent);
                }
            }
        
            return $htmlContent;
        }
        
        // Function to apply CSS styles to HTML element
        private function applyStyles($element, $properties) {
            // Construct style attribute
            $style = 'style="';
            foreach ($properties as $property) {
                $style .= $property->getRule() . ':' . $property->getValue() . ';';
            }
            $style .= '"';
        
            // Insert style attribute into HTML element
            return preg_replace('/(style=".*?)"/', '$1;' . $style . '"', $element);
        }

        public function renderStyledHTML($htmlTemplateLink){
            $htmlContent = file_get_contents($htmlTemplateLink);

            $pattern = <<<PATTERN
            /href=.<\?php echo getenv\('BASE_URL'\) \?>(.+\.css)/
            PATTERN;
            preg_match_all($pattern,$htmlContent,$matches); // Extract the css links from the html file

            if(count($matches[1]) < 1){
                // Send the base html content
                echo "Nothing";
                return;
            }

            $htmlContent = preg_replace("/\s*<link.+\.css(\"|')>\s*/","",$htmlContent); // Remove the style tags from the html template
            $cssFiles = $matches[1];
            $cssContent = '';

            foreach ($cssFiles as $cssFile) {
                $cssContent .= file_get_contents("." . $cssFile);
            }

            //echo $cssContent;
            $page = $this->applyStylesToHTML($htmlContent,$cssContent);

            /* $tempFile = tmpfile(); // Create a temp file
            
            fwrite($tempFile, $page); // Write the template content to the temporary file
            rewind($tempFile); // Move the file pointer to the beginning of the file
            ob_start(); // Start output buffering

            include stream_get_meta_data($tempFile)['uri'];
            $output = ob_get_clean(); // Get the contents of the output buffer
            fclose($tempFile); // Close and remove the temporary file

            echo $output; // Output the final HTML with executed PHP logic */
        }
    }