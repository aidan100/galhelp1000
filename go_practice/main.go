package main

import (
	"net/http"
	"strconv"
	"strings"

	"github.com/gin-gonic/gin"
	"encoding/json"
)

func main() {
	r := gin.Default()

	r.GET("/", func(c *gin.Context) {
		input := c.Query("input_text")

		total, err := calculateTotal(input)
		if err != nil {
			c.Error(err)
		}

		c.JSON(http.StatusOK, gin.H{
			"answer": total,
		})
	})

	r.Run("0.0.0.0:80")
}

type Response struct {
    Error      error  `json:"error"`
    Input_text string `json:"string"`
    Answer     int    `json:"answer"`
}

func calculateTotal(text string) (int, error) {
	
	lines := strings.Split(text, " newline")
	var marks []int

	// Handle the input by adding each line to an array and parsing each "mark" as an integer
	for _, line := range lines {
		modules := strings.Split(line, ", ")
		mark, err := strconv.Atoi(modules[1])
		if err != nil {
			return 0, err
		}
		marks = append(marks, mark)
	}

	// Find the total grade
	marksSum := 0
	for _, mark := range marks {
		marksSum += mark
	}
	
	resp := &Response{
		Error: nil,
		Input_text: input,
		Answer: markSum,
	}

	j, err := json.Marshal(resp)
	if err != nil {
		fmt.Printf("Err : %v", err)
		return
	}


}
