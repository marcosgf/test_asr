import http.client, urllib.parse, json, os, time
from sys import argv
from os.path import join, dirname


def transcribeAudio(path_to_audio_file, samplerate):
    headers = {"Content-type": "audio/wav; codec=\"audio/pcm\"; samplerate="+samplerate}

    with open(path_to_audio_file, 'rb') as audio_file:
        response = ""
        try:
            body = audio_file.read()
            #Connect to server to recognize the wave binary
            conn = http.client.HTTPConnection("138.121.71.38:8080")
            conn.request("POST", "/client/dynamic/recognize",
                   body, headers)
            response = conn.getresponse().read().decode("UTF-8")
            conn.close()
        finally:
            audio_file.close()

        return response


if __name__ == "__main__":

    if len(argv) != 3:
        print("Usage: " + argv[0] +" <samplerate> <wav_list_file>")
        print()
        print("<samplerate> \t is the audio sampling frequency. All audios in " \
              "the wav_list_file must have the same sampling frequency, " \
              "which must be 8000 or 16000.")
        print("<wav_list_file> \t is a list with .wav files to be recognized." \
              "Format: one audio per line. ")
        exit()

    samplerate = argv[1]
    file_list = argv[2]

    with open(file_list, 'r') as audio_list:
        for audio_file in audio_list:
            response = transcribeAudio(audio_file.strip(), samplerate)
            lexical = ""
            data=json.loads(response)
            if data:
                if data['hypotheses'][0]:
                    print(audio_file.strip() + '\t' + data['hypotheses'][0]['utterance'], flush=True)
