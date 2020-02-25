<?php


namespace Alura\BuscadorDeCursos\Tests;

use Alura\BuscadorDeCursos\Buscador;
use GuzzleHttp\ClientInterface;
use phpDocumentor\Reflection\Types\Void_;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use Symfony\Component\DomCrawler\Crawler;

class TestBuscadorDeCursos extends TestCase
{
    private $httpClientMock;
    private $url = 'url-teste';

    protected function setUp(): Void
    {
        $html = <<<FIM
        <html lang="en">
            <body>
                <span class="card-curso__nome">Curso Teste 1</span>
                <span class="card-curso__nome">Curso Teste 2</span>
                <span class="card-curso__nome">Curso Teste 3</span>
            </body>
        </html>
        FIM;


        try {
            $stream = $this->createMock(StreamInterface::class);
        } catch (\ReflectionException $e) {
        }
        $stream
            ->expects($this->once())
            ->method('__toString')
            ->willReturn($html);

        try {
            $response = $this->createMock(ResponseInterface::class);
        } catch (\ReflectionException $e) {
        }
        $response
            ->expects($this->once())
            ->method('getBody')
            ->willReturn($stream);

        try {
            $httpClient = $this
                ->createMock(ClientInterface::class);
        } catch (\ReflectionException $e) {
        }
        $httpClient
            ->expects($this->once())
            ->method('request')
            ->with('GET', $this->url)
            ->willReturn($response);

        $this->httpClientMock = $httpClient;
    }

    public function testBuscadorDeveRetornarCursos()
    {
        $crawler = new Crawler();
        $buscador = new Buscador($this->httpClientMock, $crawler);
        $cursos = $buscador->buscar($this->url);

        $this->assertCount(3, $cursos);
        $this->assertEquals('Curso Teste 1', $cursos[0]);
        $this->assertEquals('Curso Teste 2', $cursos[1]);
        $this->assertEquals('Curso Teste 3', $cursos[2]);
    }
}