#include <ESP8266WiFi.h>

#define SENHA_REDE "bruninho123456"
#define SSID_REDE "GVT_2530"

WiFiClient client;
const char http_site[] = "localhost/humid/insertHumid.php";
const int http_port = 8080;
 
// Variáveis globais
IPAddress server(127,0,0,1);

void FazConexaoWiFi();
float LerUmidade();
bool getPage(int humid);

void setup() {

    Serial.begin(9600);//Abrir aporta serial na velocidade 9600
    //lastConnectionTime = 0;
    FazConexaoWiFi();
    Serial.println("Projeto de IoT - irrigador");

}

void loop()
{
    float UmidadePercentualLida;
    int UmidadePercentualTruncada;
    char FieldUmidade[11];
    
  
    if (client.connected())
    {
        client.stop();
        Serial.println();
    }
 
    UmidadePercentualLida = LerUmidade();
    //UmidadePercentualTruncada = (int)UmidadePercentualLida; //trunca umidade como número inteiro
    /*
    //verifica se está conectado no WiFi e se é o momento de enviar dados ao ThingSpeak
    if(!client.connected() && 
      (millis() - lastConnectionTime > INTERVALO))
    {
        sprintf(FieldUmidade,"field1=%d",UmidadePercentualTruncada);
        EnviaInformacoesThingspeak(FieldUmidade);
    }
 */

   Serial.println("Gravando dados no BD: "); 
   Serial.print((int)UmidadePercentualLida); 
   Serial.println(" %");
 
  // Envio dos dados do sensor para o servidor via GET
   if ( !getPage((int)UmidadePercentualLida) ) {
    Serial.println("GET request failed");
   }
   delay(1000);
}
void FazConexaoWiFi(){
    client.stop();
    Serial.println("Conectando-se à rede WiFi...");
    Serial.println();
    delay(1000);
    WiFi.begin(SSID_REDE, SENHA_REDE);
  
    while(WiFi.status() != WL_CONNECTED){
      delay(500);
      Serial.print(".");  
    }
  
    Serial.println("");
    Serial.println("WiFi connectado com sucesso!");
    Serial.println("IP obtido: ");
    Serial.println(WiFi.localIP());
    delay(1000);

}

float LerUmidade(){

    int valorADC;
    float percent_umidade;

    valorADC = analogRead(0);
    Serial.print("[Leitura ADC]");
    Serial.println(valorADC);

    percent_umidade = 100 * ((978-(float)valorADC)/978);
    Serial.print("[Umidade Percentual]");
    Serial.print(percent_umidade);
    Serial.println("%");
  
    return percent_umidade;
}

bool getPage(int humid){
    if( !client.connect(server, http_port)){
      Serial.println("Falha na conexao com o site");
      return false;
    }
    
    String param = "/?humid=" + String(humid);
    Serial.println(param);
    client.println("GET /humid/insertHumid.php" + param + "HTTP/1.1");
    client.println("Host: ");
    client.println(http_site);
    client.println("Connection: close");
    client.println();
    client.println();
  
    while(client.available()){
      String line = client.readStringUntil('\r');
       Serial.print(line); 
    }
    
    return true;  
}

