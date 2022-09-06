def get_classification(input_text):
    lines = input_text.split("newline")
    lines.pop()

    total_marks = 0
    num_of_modules = 0
    av_mark = 0
    classification = ""

    for val in lines:
        line_array = val.split(",")
        total_marks += int(line_array[1])
        num_of_modules += 1

    av_mark = total_marks / num_of_modules

    if (av_mark < 50 and av_mark >= 0):
        classification = "Fail"
    elif (av_mark < 60):
        classification = "Pass"
    elif (av_mark < 70):
        classification = "Pass with Commendation"
    elif (av_mark < 100):
        classification = "Pass with Distinction"
    else:
        classification = "Error"

    return classification






    