<?php

declare(strict_types = 1);

namespace App\UI\Icon;

use Latte\Compiler;
use Latte\MacroNode;
use Latte\Macros\MacroSet;
use Latte\PhpWriter;
use Nette\InvalidArgumentException;
use Nette\Utils\Strings;

class SvgMacro
{

	private string $svgDir;

	public function __construct(string $svgDir)
	{
		$this->svgDir = $svgDir;
	}

	public function install(Compiler $compiler): void
	{
		$set = new MacroSet($compiler);
		$set->addMacro('renderSvg', function (MacroNode $node, PhpWriter $writer): string {
			$words = $node->tokenizer->fetchWordWithModifier([]);
			$param = $writer->formatArray();

			if ($words === null) {
				throw new InvalidArgumentException('Svg macro expects atleast 1 parameter');
			}

			$svgFileName = $writer->formatWord($words[0]);

			if ($param !== '') {
				$param = substr($param, 1, -1); // removes array() or []
			}

			$svgFileName = Strings::trim($svgFileName);
			$svgFile = "'" . $this->svgDir . "/' . " . $svgFileName;

			$condition = 'is_readable(' . $svgFile . ') && is_file(' . $svgFile . ')';

			$printSvg = $param === ''
				? 'echo file_get_contents(' . $svgFile . ');'
				: '
					if (is_array(' . $param . ')) {
						$svg = file_get_contents(' . $svgFile . ');
						foreach (' . $param . 'as $key => $value) {
							$attr = $key . "=\"" . $value . "\""; 
							$svg = str_replace(\'<svg\', \'<svg \' . $attr, $svg);   
						}
						
						echo $svg;
					}
				';

			$msg = "'Given svg file not found or unreadable ('." . $svgFileName . ".').'";
			$error = 'throw new InvalidArgumentException(' . $msg . ');';

			return $writer->write('if (' . $condition . ') {' . $printSvg . ' } else { ' . $error . '}');
		});
	}

}
