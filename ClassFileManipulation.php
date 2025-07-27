<?php
###------------------------------------------------------------------
/*
* Text File Manipulation Class
* Author: Boris Penck <boris@gamate.com>
* Date: 2001-06-24
*/
class FileMan {

	var $basefile = "";
	var $filearray = array();
	var $totallines = 0;
	
	/*
	* setFile(string filename)
	* set filename for further use
	*/
	function setFile($file="") {
		if($file!="" && file_exists($file)) {
			$this->basefile = $file;
			$this->filearray = $this->readFileToArray();
			foreach($this->filearray as $key => $value) {
				$this->totallines++;
			}
		} 
	}

	// Do not call ! Internal function 
	function outputError($errorNo) {
		switch($errorNo) {
			case 1:
				echo '<b>Error</b>: No file selected. Define your file with $class->setFile(file) !';
			break;
			case 2:
				echo '<b>Error</b>: Selected File not found or bad file permissions !';
			break;
			case 3:
				echo '<b>Error</b>: File not modified or given line not found';
			break;
		
			default:
				echo '<b>Error</b>: Unkown error in Class FileMan';
		}
	}
	
	// Do not call ! Internal function
	function readFileToArray() {
		if($this->basefile!="") {
			$tempArray = file($this->basefile);
			return $tempArray;
		} else {
			$this->outputError(1);
		}
	}

	###---------------------------------------------------------------
	/*
	* Callable functions
	*
	* below this, there all all callable function to manipulate a file
	*
	*/
	###---------------------------------------------------------------
	
	
	/*
	* readEntire()
	* 	returns an array containing the complete file, each arrayelement
	* 	contains one line of the file
	*/
	function readEntire() {
		if($this->basefile!="") {
			return $this->filearray;
		} else {
			$this->outputError(1);
		}
	}
	
	/*
	* readFirstX(int amount of lines)
	*	returns an array containing the first X Lines
	*/
	function readFirstX($amountOfLines) {
		if($this->basefile!="") {
			$tempArray = array();
			for($line=0;$line<=($amountOfLines-1);$line++) {
				$tempArray[] = $this->filearray[$line];
			}
			return $tempArray;
		} else {
			$this->outputError(1);
		}
	}
	
	/*
	* readLastX(int amount of lines)
	*	returns an array contaiing the last X lines
	*/
	function readLastX($amountOfLines) {
		if($this->basefile!="") {
			$tempArray = array();
			$startLine = $this->totallines - $amountOfLines;
			$i=0;
			foreach($this->filearray as $key => $value) {
				if($i>=$startLine) {
					$tempArray[] = $value;
				}
				$i++;
			}
			return $tempArray;
		} else {
			$this->outputError(1);
		}
	}
	
	/*
	* readFromX(int start line, char upto char)
	*	returns an array contaiing the last X lines
	*/
	function readFromX($lineNo, $char) {
		if($this->basefile!="") {
			$tempArray = array();
			$startLine = $lineNo;
			$i=0;
			foreach($this->filearray as $key => $value) {
				if(($i>=$startLine)) { 
					$tempArray[] = $value;
					if (trim($value) == trim($char)) break;
				}
				$i++;
				
			}
			return $tempArray;
		} else {
			$this->outputError(1);
		}
	}
	
	/*
	* writeEnd(string string)
	*	appends a line to the file
	*/
	function writeEnd($writeStr) {
		if($this->basefile!="") {
			$fp = fopen($this->basefile,"a");
			if($fp) {
				if(!ereg("\n$",$writeStr)) {
					$writeStr .= "\n";
				}
				fputs($fp,$writeStr);
				fclose($fp);
				return true;
			} else {
				$this->outputError(2);
			}
		} else {
			$this->outputError(1);
		}
	}

    /*
    * writebegin(string string)
    *       prepends a line to the file
    */
	function writeBegin($writeStr) {
		if($this->basefile!="") {
			$fp = @fopen($this->basefile,"w");
			if($fp) {
				if(!ereg("\n$",$writeStr)) {
					$writeStr .= "\n";
				}
				fputs($fp,$writeStr);
				foreach($this->filearray as $lNo => $lineValue) {
					fputs($fp,$lineValue);
				}
				fclose($fp);
				return true;
			} else {
				$this->outputError(2);
			}
		} else {
			$this->outputError(1);
		}
	}
	
    /*
    * delLineNo(int number of line)
    *       delete a line is the file, lines begin with 1 (not 0!)
    */
	function delLineNo($lineNo) {
		if($this->basefile!="") {
			$fp = @fopen($this->basefile,"w");
			if($fp) {
				foreach($this->filearray as $lNo => $lineValue) {
					if($lNo != ($lineNo-1)) {
						fputs($fp,$lineValue);
					} else {
						$modificated = 1;
					}
				}
				fclose($fp);
				if($modificated==1) {
					return true;
				} else {
					$this->outputError(3);
				}
			} else {
				$this->outputError(2);
			}
		} else {
			$this->outputError(1);
		}
	}
	
	
	/*
    * delLineupto(int number of line, charac)
    *       delete lines in the filestarting from lineno and upto the charac is found, lines begin with 1 (not 0!)
	*	this is vinoy's function
    */
	function delLineupto($lineNo, $charac) {
		$temp =0;
		if($this->basefile!="") {
			$fp = @fopen($this->basefile,"w");
			if($fp) {
				foreach($this->filearray as $lNo => $lineValue) {
					if($lNo == ($lineNo-1+$temp)) {
						$modificated = 1;
						//if($temp < $noLines) $temp++;
						if(trim($lineValue) != trim($charac)) $temp++;
					} else {
						fputs($fp,$lineValue);
					}
					
				}
				fclose($fp);
				if($modificated==1) {
					return true;
				} else {
					$this->outputError(3);
				}
			} else {
				$this->outputError(2);
			}
		} else {
			$this->outputError(1);
		}
	}
	
	/*
    * delmanyLines(int number of line, no:of lines)
    *       delete lines in the filestarting from lineno and upto no: of lines, lines begin with 1 (not 0!)
	*	this is vinoy's function
    */
	function delmanyLines($lineNo, $noLines) {
		$temp =0;
		if($this->basefile!="") {
			$fp = @fopen($this->basefile,"w");
			if($fp) {
				foreach($this->filearray as $lNo => $lineValue) {
					if($lNo == ($lineNo-1+$temp)) {
						$modificated = 1;
						if($temp < $noLines) $temp++;
					} else {
						fputs($fp,$lineValue);
					}
					
				}
				fclose($fp);
				if($modificated==1) {
					return true;
				} else {
					$this->outputError(3);
				}
			} else {
				$this->outputError(2);
			}
		} else {
			$this->outputError(1);
		}
	}
	
	
    /*
    * writeAfterLine(int line number, string string)
    *       insert a line after a given line number, lines begin with 1
    */
	function writeAfterLine($lineNo,$writeStr) {
		if($this->basefile!="") {
			$fp = @fopen($this->basefile,"w");
			if($fp) {
				if(!ereg("\n$",$writeStr)) {
					$writeStr .= "\n";
				}
				foreach($this->filearray as $lNo => $lineValue) {
					if($lNo==($lineNo-1)) {
						fputs($fp,$lineValue);
						fputs($fp,$writeStr);
						$modificated = 1;
					} else {
						fputs($fp,$lineValue);
					}
				}
				fclose($fp);
				if($modificated==1) {
					return true;
				} else {
					$this->outputError(3);
				}
			} else {
				$this->outputError(2);
			}
		} else {
			$this->outputError(1);
		}
	}
	
    /*
    * replaceLine(int number of line, string string)
    *       replaces a line with the given sting(line), lines begin with 1
    */
	function replaceLine($lineNo,$replaceStr) {
		if($this->basefile!="") {
			$fp = @fopen($this->basefile,"w");
			if($fp) {
				if(!ereg("\n$",$replaceStr)) {
					$replaceStr .= "\n";
				}
				foreach($this->filearray as $lNo => $lineValue) {
					if($lNo==($lineNo)) {
						fputs($fp,$replaceStr);
						$modificated = 1;
					} else {
						fputs($fp,$lineValue);
					}
				}
				fclose($fp);
				if($modificated==1) {
					return true;
				} else {
					$this->outputError(3);
				}
			} else {
				$this->outputError(2);
			}
		} else {
			$this->outputError(1);
		}
	}
	
    /*
    * getLine(int number of line)
    *       returns a string containing line X of the file, lines begin with 0!
    */
	function getLine($lineNo) {
		if($this->basefile!="") {
			return $this->filearray[$lineNo];
		} else {
			$this->outputError(1);
		}
	}
	
    /*
    * getLastLine(int number of line)
    *       returns a string containing the last line of the file
    */
	function getLastLine() {
		if($this->basefile!="") {
			return $this->filearray[$this->totallines];
		} else {
			$this->outputError(1);
		}
	}
	
	function getLastLineNo() {
		if($this->basefile!="") {
			return $this->totallines;
		} else {
			$this->outputError(1);
		}
	}
	
    /*
    * getFirstLine(int number of line)
    *       returns a string containing the first line of the file
    */
	function getFirstLine() {
		if($this->basefile!="") {
			return $this->filearray[0];
		} else {
			$this->outputError(1);
		}
	}
	
    /*
    * getRandomLine()
    *       returns a string containing a random line of the file
    */
	function getRandomLine() {
		if($this->basefile!="") {
			$randInt = rand(0,$this->totallines);
			return $this->filearray[$randInt];
		} else {
			$this->outputError(1);
		}
	}
	
    /*
    * searchInLine(string string)
    *       searches each line for a string or regular expression and
	*    	returns an array of $linenumber => $linecontent
    */
	function searchInLine($sStr="") {
		$tempArray = array();
		foreach($this->filearray as $lineNo => $lineValue) {
			if(eregi($sStr,$lineValue)) {
				$tempArray[$lineNo] = $lineValue;
				$found = 1;
			}
		}
		if($found==1) {
			return $tempArray;
		} else {
			return false;
		}
	}
}
?>
