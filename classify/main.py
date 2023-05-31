from ultralytics import YOLO
import glob
import os
import time
import mysql.connector as sql

# Load a model
model = YOLO('best.pt')  # load a custom model
counter = 1

if __name__ == "__main__":
    mydb = sql.connect(
        host="localhost",
        user="root",
        password="root",
        database="keuh-classification"
    )
    cursor = mydb.cursor()
    # images directory inference
    images_list = []
    while True:
        try:
            cursor.execute("SELECT image_directory FROM carts WHERE id = %s", (counter,))
            myresult = cursor.fetchall()
            counter += 1
            image_directory = myresult[0][0]
            path = image_directory + '/'
            directory = os.path.dirname(path) + '/*jpg'
            images_path = glob.glob(directory)
            for img in images_path:
                try:
                    if img not in images_list:
                        images_list.append(img)
                        start = time.time()
                        # Predict with the model
                        result = model(img)  # predict on an image
                        print("[INFO] inference time whole process: {}".format(time.time() - start))
                        predict = result[0].names[int(result[0].probs.argmax())]
                        predict = predict + '\n'
                        cursor.execute("UPDATE carts SET labels = %s WHERE id = %s", (predict, counter-1))
                        mydb.commit()
                    else:
                        continue
                except Exception as e:
                    print(e)
                    continue
        except Exception as e:
            print(e)
            counter -= 1
            pass
